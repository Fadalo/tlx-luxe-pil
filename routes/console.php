<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();
*/

Schedule::command('luxe:scheadule-check-auto-activated')->daily()->runInBackground();
Schedule::command('luxe:scheadule-check-instructor-insentif')->everyTenSeconds()->runInBackground();
Schedule::command('luxe:scheadule-check-close-session')->everyTenSeconds()->runInBackground();
