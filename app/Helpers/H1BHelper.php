<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

class H1BHelper
{

    public static function clearPhoneNo($value)
    {
        $val = trim(str_replace('-','',str_replace(' ','',str_replace('+','',$value))));
        return $val;
    }
    public function status_payment($value){
        return ($value=='not_paid')?'NOT PAID':'PAID';
    }
    public static function isHasDecimal($val)
    {
        if (fmod($val, 1) !== 0.0) {
            return number_format($val,2);
        } else {
            return $val;
        }
    }
    public function lastUpdated($startDateTime)
    {
        //return 'aaaa';
        //print_r($startDate);
        //exit();
        // Define start date
        $startDate = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::parse($startDateTime));
      
        // Get the current date and time
        $endDate = Carbon::now();

        // Calculate the total difference in minutes
        $totalMinutes = $startDate->diffInMinutes($endDate);

        // Convert to days, hours, and minutes
        $days = intdiv($totalMinutes, 1440); // 1440 minutes in a day
        $remainingMinutesAfterDays = $totalMinutes % 1440;

        $hours = intdiv($remainingMinutesAfterDays, 60);
        $minutes = $remainingMinutesAfterDays % 60;

        // Display the difference
        if ($days > 0) {
            return "{$days} days {$hours} hours, and {$minutes} minutes ago";
        } elseif ($hours > 0) {
            return "{$hours} hours and {$minutes} minutes ago";
        } else {
            return "{$minutes} minutes ago";
        }
       
    }
    function getTargetTime()
    {

    }
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

    public function CamelCase($string){
        
            // Convert string to lowercase and then split it by underscores
            $words = explode('_', strtolower($string));
        
            // Capitalize the first letter of each word
            $words = array_map('ucfirst', $words);
        
            // Join the words back together
            return implode('', $words);
    }

    public static function combine_based_on_second($first, $second) {
        $NewFilter = [];
        $combinedFull = array_merge_recursive($first,$second);
        
        foreach ($second as $key => $value) {    
            if( array_key_exists($key,$combinedFull) ){
                $NewFilter[$key] = $combinedFull[$key];
            }
        }

        //print_r('<pre>');
        //print_r($combinedFull);
        //exit();
        return $NewFilter;
    }

    function getStringFromCallback($item, $callback) {
        // Start buffering the output
        ob_start();
        
        // Call the callback function
        $callback($item);
        
        // Get the content from the buffer and clean the buffer
        $output = ob_get_clean();
        
        // Return the captured output as a string
        return $output;
    }

    function callback($item){
        return $item['first_name'];
    }
}