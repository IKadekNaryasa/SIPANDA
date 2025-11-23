<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('samsat:check-jatuh-tempo')->monthlyOn(23, '08:40')->timezone('Asia/Makassar');
Schedule::command('samsat:check-jatuh-tempo-7hari')->dailyAt('08:25')->timezone('Asia/Makassar');
