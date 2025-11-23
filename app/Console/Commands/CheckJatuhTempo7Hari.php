<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Kendaraan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class CheckJatuhTempo7Hari extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'samsat:check-jatuh-tempo-7hari';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cek kendaraan yang jatuh tempo 7 hari dari sekarang dan kirim notifikasi WhatsApp';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Memulai pengecekan kendaraan jatuh tempo 7 hari...');

        $today = Carbon::now()->startOfDay();
        $sevenDaysFromNow = Carbon::now()->addDays(7)->endOfDay();

        $kendaraans = Kendaraan::with('user')
            ->whereBetween('tgl_jatuh_tempo', [$today, $sevenDaysFromNow])
            ->whereHas('user', function ($query) {
                $query->whereNotNull('wa')
                    ->where('wa', '!=', '');
            })
            ->get();

        if ($kendaraans->isEmpty()) {
            $this->info('Tidak ada kendaraan yang jatuh tempo dalam 7 hari ke depan.');
            return 0;
        }

        $this->info("Ditemukan {$kendaraans->count()} kendaraan yang akan jatuh tempo dalam 7 hari.");

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

        $message = "🚨 *PERINGATAN URGENT - JATUH TEMPO KENDARAAN* 🚨\n\n";
        $message .= "Yth. {$kendaraan->user->name},\n\n";
        $message .= "⚠️ *PERHATIAN!* Kendaraan Anda akan jatuh tempo dalam waktu dekat:\n\n";
        $message .= "📋 *Detail Kendaraan:*\n";
        $message .= "• Kode Barang : {$kendaraan->kode_barang}\n";
        $message .= "• Jenis       : {$kendaraan->jenis_barang}\n";
        $message .= "• Merk/Type   : {$kendaraan->merk_type}\n";
        $message .= "• No. Polisi  : {$kendaraan->N_polisi}\n";
        $message .= "• Tahun       : {$kendaraan->tahun_pembelian}\n\n";
        $message .= "📅 *Tanggal Jatuh Tempo:* {$tglJatuhTempo}\n";
        $message .= "⏰ *Sisa Waktu         :* {$sisaHari} hari lagi\n\n";

        if ($sisaHari <= 7) {
            $message .= "🔴 *SEGERA!* Waktu pembayaran sangat terbatas!\n\n";
        } else {
            $message .= "🟡 Mohon segera lakukan pembayaran pajak kendaraan.\n\n";
        }

        $message .= "Terima kasih atas perhatiannya.\n\n";
        $message .= "Lakukan konfirmasi pembayaran pajak pada https://sipanda-kesbangpol.iknproject.site/";

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
