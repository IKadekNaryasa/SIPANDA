<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class PromoteUserToMaster extends Command
{
    protected $signature = 'users:promote-master {nip : NIP of the existing admin account}';

    protected $description = 'Promote an existing admin account to the master role';

    public function handle(): int
    {
        $user = User::where('nip', $this->argument('nip'))->first();

        if (! $user) {
            $this->error('User dengan NIP tersebut tidak ditemukan.');

            return self::FAILURE;
        }

        if ($user->role === 'master') {
            $this->info('User tersebut sudah memiliki role master.');

            return self::SUCCESS;
        }

        if ($user->role !== 'admin') {
            $this->error('Hanya user dengan role admin yang dapat dipromosikan menjadi master.');

            return self::FAILURE;
        }

        $user->update(['role' => 'master']);
        $this->info('User berhasil dipromosikan menjadi master.');

        return self::SUCCESS;
    }
}
