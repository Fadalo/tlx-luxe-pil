<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

class H1BHelper
{

    function isH1BDate() {
        // Get the current date
        $currentDate = new DateTime();
    
        // Set the start and end dates for H-1B filing
        $startDate = new DateTime($currentDate->format('Y') . '-04-01'); // April 1st of the current year
        $endDate = new DateTime($currentDate->format('Y') . '-04-07'); // April 7th of the current year

        // Check if the current date is within the H-1B filing period
        if ($currentDate >= $startDate && $currentDate <= $endDate) {
            return true; // It is H-1B filing date
        } else {
            return false; // It is not H-1B filing date
        }
    }
    public function adminRoute(){
        Route::get('/test',function(){
            print_r( config('menu-admin.menu.Dashboard'));
        });
    }

}