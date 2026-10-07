<?php

namespace Tests\Feature;

use App\Models\Kendaraan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Tests\TestCase;

class AdminExcelExportTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_export_managed_users_as_xlsx_without_user_ids_or_passwords(): void
    {
        $admin = $this->createUser('admin', '100000000000000013');
        $operator = $this->createUser('operator', '100000000000000014');
        $this->createUser('master', '100000000000000015');

        $response = $this->actingAs($admin)->get(route('user.export'));

        $response->assertOk();
        $this->assertStringContainsString(
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            $response->headers->get('content-type')
        );
        $spreadsheet = $this->loadSpreadsheet($response->streamedContent());
        $sheet = $spreadsheet->getActiveSheet();

        $this->assertSame(
            ['Nama', 'NIP', 'WhatsApp', 'Status', 'Role', 'Dibuat', 'Diperbarui'],
            $sheet->rangeToArray('A1:G1')[0]
        );
        $this->assertSame($operator->name, $sheet->getCell('A2')->getValue());
        $this->assertSame($operator->nip, $sheet->getCell('B2')->getValue());
        $this->assertSame(2, $sheet->getHighestRow());
    }

    public function test_admin_can_export_all_vehicles_with_holder_name_instead_of_user_uuid(): void
    {
        $admin = $this->createUser('admin', '100000000000000016');
        $operator = $this->createUser('operator', '100000000000000017');

        Kendaraan::create([
            'kode_barang' => 'KEND-EXPORT-01',
            'jenis_barang' => 'Sepeda Motor',
            'merk_type' => 'Honda Test',
            'cc' => 125,
            'tahun_pembelian' => 2024,
            'N_rangka' => 'RANGKA-EXPORT-01',
            'N_mesin' => 'MESIN-EXPORT-01',
            'N_polisi' => 'DK 1234 AA',
            'harga' => 20000000,
            'user_id' => $operator->id,
            'tgl_jatuh_tempo' => '2027-01-31',
            'status' => 'active',
        ]);
        Kendaraan::create([
            'kode_barang' => 'KEND-EXPORT-02',
            'jenis_barang' => 'Mobil',
            'merk_type' => 'Toyota Test',
            'cc' => 1500,
            'tahun_pembelian' => 2023,
            'N_rangka' => 'RANGKA-EXPORT-02',
            'N_mesin' => 'MESIN-EXPORT-02',
            'N_polisi' => 'DK 5678 BB',
            'harga' => 250000000,
            'user_id' => null,
            'tgl_jatuh_tempo' => '2027-02-28',
            'status' => 'nonactive',
        ]);

        $response = $this->actingAs($admin)->get(route('kendaraan.export'));

        $response->assertOk();
        $spreadsheet = $this->loadSpreadsheet($response->streamedContent());
        $sheet = $spreadsheet->getActiveSheet();

        $this->assertSame('Nama Pemegang', $sheet->getCell('J1')->getValue());
        $this->assertSame('User operator', $sheet->getCell('J2')->getValue());
        $this->assertSame('On-Sett', $sheet->getCell('J3')->getValue());
        $this->assertSame('KEND-EXPORT-01', $sheet->getCell('A2')->getValue());
        $this->assertSame(125, $sheet->getCell('D2')->getValue());
        $this->assertSame(3, $sheet->getHighestRow());
        $this->assertNull($sheet->getCell('O1')->getValue());
    }

    private function createUser(string $role, string $nip): User
    {
        return User::create([
            'name' => "User {$role}",
            'wa' => '08123456789',
            'nip' => $nip,
            'password' => 'password',
            'role' => $role,
        ]);
    }

    private function loadSpreadsheet(string $contents): \PhpOffice\PhpSpreadsheet\Spreadsheet
    {
        $path = tempnam(sys_get_temp_dir(), 'sipanda-export-');
        file_put_contents($path, $contents);

        try {
            return IOFactory::load($path);
        } finally {
            unlink($path);
        }
    }
}
