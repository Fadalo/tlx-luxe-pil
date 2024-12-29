<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Schedule::command('luxe:scheadule-check-auto-activated')->everyTenSeconds()->runInBackground();
Schedule::command('luxe:scheadule-check-auto-burn-ticket')->everyTenSeconds()->runInBackground();