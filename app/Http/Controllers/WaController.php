<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WaController extends Controller
{

    public $data = [];
    public $config = [];
    public function callback(){
        dd($_POST);

    }
    public static function doSend(Request $request)
    {
        
            // Validate the request data
            $request->validate([
                'number' => 'required|string',
                'message' => 'required|string',
            ]);
         
            $this->doSendMessage($request->input('phone_no'),$request->input('message'));
        
    }
    public function doSendMessage($phone_no,$message){

        $apiUrl = env('WA_API')."/send";
    
        try {
            // Send POST request to the external API
            $response = Http::post($apiUrl, [
                'number' => $phone_no,
                'message' => $message,
            ]);

            // Check if the response is successful
            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'data' => $response->json(),
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to send message.',
            ], $response->status());
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public static function doGetMessageHistory($phone_no)
    {

        $apiUrl = env('WA_API')."/chat-history/{$phone_no}";
       // dd($apiUrl);
        try {
            // Send POST request to the external API
            $response = Http::get($apiUrl);

            // Check if the response is successful
            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'data' => $response->json(),
                ]);
            }
            return response()->json([
                'success' => false,
                'message' => 'Failed To Get Message.',
            ], $response->status());
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }

    }
    public function doSendImage()
    {

    }
    

}
