<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Kendaraan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class CheckSamsat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'samsat:check-jatuh-tempo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cek kendaraan yang jatuh tempo bulan depan dan kirim notifikasi WhatsApp';


    public function handle()
    {
        $this->info('Memulai pengecekan kendaraan jatuh tempo...');

        $startOfNextMonth = Carbon::now()->addMonth()->startOfMonth();
        $endOfNextMonth = Carbon::now()->addMonth()->endOfMonth();

        $kendaraans = Kendaraan::with('user')
            ->whereBetween('tgl_jatuh_tempo', [$startOfNextMonth, $endOfNextMonth])
            ->whereHas('user', function ($query) {
                $query->whereNotNull('wa')
                    ->where('wa', '!=', '');
            })
            ->get();

        if ($kendaraans->isEmpty()) {
            $this->info('Tidak ada kendaraan yang jatuh tempo bulan depan.');
            return 0;
        }

        $this->info("Ditemukan {$kendaraans->count()} kendaraan yang akan jatuh tempo.");

        $successCount = 0;
        $failedCount = 0;

        $bar = $this->output->createProgressBar($kendaraans->count());
        $bar->start();

        foreach ($kendaraans as $kendaraan) {
            try {
                $sent = $this->sendWhatsAppNotification($kendaraan);

                if ($sent) {
                    $successCount++;
                } else {
                    $failedCount++;
                    $this->newLine();
                    $this->error("Gagal mengirim ke: {$kendaraan->user->name} - {$kendaraan->N_polisi}");
                }
            } catch (\Exception $e) {
                $failedCount++;
                $this->newLine();
                $this->error("Error untuk {$kendaraan->N_polisi}: {$e->getMessage()}");
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        $this->info("=== SUMMARY ===");
        $this->info("Total kendaraan: {$kendaraans->count()}");
        $this->info("Berhasil dikirim: {$successCount}");
        $this->error("Gagal dikirim: {$failedCount}");

        return 0;
    }


    private function sendWhatsAppNotification(Kendaraan $kendaraan): bool
    {
        if (!$kendaraan->user || !$kendaraan->user->wa) {
            return false;
        }

        $wa = $this->formatWaNumber($kendaraan->user->wa);

        $tglJatuhTempo = Carbon::parse($kendaraan->tgl_jatuh_tempo)->format('d F Y');

        $sisaHari = (int) Carbon::now()->diffInDays(Carbon::parse($kendaraan->tgl_jatuh_tempo), false);

        $message = "🚗 *PENGINGAT JATUH TEMPO KENDARAAN* 🚗\n\n";
        $message .= "Yth. {$kendaraan->user->name},\n\n";
        $message .= "Kami ingin mengingatkan bahwa kendaraan Anda akan jatuh tempo:\n\n";
        $message .= "📋 *Detail Kendaraan:*\n";
        $message .= "• Kode Barang : {$kendaraan->kode_barang}\n";
        $message .= "• Jenis       : {$kendaraan->jenis_barang}\n";
        $message .= "• Merk/Type   : {$kendaraan->merk_type}\n";
        $message .= "• No. Polisi  : {$kendaraan->N_polisi}\n";
        $message .= "• Tahun       : {$kendaraan->tahun_pembelian}\n\n";
        $message .= "📅 *Tanggal Jatuh Tempo:* {$tglJatuhTempo}\n";
        $message .= "⏰ *Sisa Waktu         :* {$sisaHari} hari lagi\n\n";
        $message .= "Mohon segera lakukan pembayaran pajak kendaraan.\n\n";
        $message .= "Terima kasih atas perhatiannya.\n\n";
        $message .= "lakukan konfirmasi pembayaran pajak pada http://103.226.139.107/.";

        try {
            $response = Http::withHeaders([
                'Authorization' => env('FONNTE_API_KEY'),
            ])->post('https://api.fonnte.com/send', [
                'target' => $wa,
                'message' => $message,
                'countryCode' => '62',
            ]);

            if ($response->successful()) {
                $result = $response->json();
                return $result['status'] ?? false;
            }

            return false;
        } catch (\Exception $e) {
            Log::error("Fonnte Error: " . $e->getMessage());
            return false;
        }
    }


    private function formatWaNumber(string $wa): string
    {
        $wa = preg_replace('/[^0-9]/', '', $wa);

        if (substr($wa, 0, 1) === '0') {
            $wa = '62' . substr($wa, 1);
        }

        if (substr($wa, 0, 2) !== '62') {
            $wa = '62' . $wa;
        }

        return $wa;
    }
}
