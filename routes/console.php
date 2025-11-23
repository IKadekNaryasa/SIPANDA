<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('samsat:check-jatuh-tempo')->monthlyOn(23, '09:00')->timezone('Asia/Makassar');
Schedule::command('samsat:check-jatuh-tempo-7hari')->dailyAt('08:55')->timezone('Asia/Makassar');
