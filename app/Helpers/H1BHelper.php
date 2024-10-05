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