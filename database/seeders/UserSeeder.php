<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $names = [
            'Parkir Kantor Kesbangpol',
            'Putu Sutawan, S.Sos.',
            'Kadek Widya Pratama',
            'Kadek Ariasa',
            'Gede Soma Ardika',
            'Gede Julyan Kusuma Ardi',
            'Gede Agus Yudiarta',
            'I Gusti Bagus Maha Wijaya',
            'Made Budiantara',
            'Kadek Deni',
            'Gusti Made Ariada',
            'Made Arya Suta',
            'Ni Komang Sri Ayu Purnamawati, S.E.',
            'I Gusti Ngurah Addy Saputra, S.E.',
            'Made Rediawan',
            'I Gusti Made Swicahya',
            'Komang Arsa',
            'Kadek Andre Diwanda',
            'Putu Juli Mahardika, S.Kom.',
            'Nyoman Ari Dharma',
            'Wahyu Aritrisnawan, S.Kom.',
            'I Komang Krisna Ariawan, S.E.',
            'Sairul Huda, S.Sos.',
            'Elvi Robin, S.H.',
            'Dra. Ketut Suseni Indrawati, M.A.P',
            'Ketut Simbayasa, S.Sos., M.A.P.',
            'Wayan Budi Adnyana',
            'M. Bachtiar',
            'Ida Bagus Komang Widnyana',
            'Ida Bagus Kade Surya Atmaja',
            'Nyoman Ari Gunawan',
            'Komang Kappa Tri Aryandono, S.IP.',
            'Nyoman Yunik Wardani',
            'Putu Yudhi Hardiana, S.Kom.',
        ];

        $users = [];
        $uniqueNips = [];

        foreach ($names as $name) {
            do {
                $nip = str_pad(mt_rand(1, 999999999999999999), 18, '0', STR_PAD_LEFT);
            } while (in_array($nip, $uniqueNips));
            $uniqueNips[] = $nip;

            $rawPassword = substr($nip, -8);

            $wa = '08' . str_pad(mt_rand(1000000000, 9999999999), 10, '0', STR_PAD_LEFT);

            $users[] = [
                'id' => (string) Str::uuid(),
                'name' => $name,
                'wa' => $wa,
                'nip' => $nip,
                'password' => Hash::make($rawPassword),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        $usersAdmin = [
            'id' => (string) Str::uuid(),
            'name' => 'I Kadek Naryasa, S.Kom',
            'wa' => '087864365344',
            'nip' => '200206092025061001',
            'password' => Hash::make('25061001'),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('users')->insert($usersAdmin);
        DB::table('users')->insert($users);
    }
}
