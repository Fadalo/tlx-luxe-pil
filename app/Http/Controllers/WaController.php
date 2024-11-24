<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WaController extends Controller
{

    public $data = [];
    public $config = [];
    public function callback(){

    }
    public function doSend(Request $request)
    {
            // Validate the request data
            $request->validate([
                'number' => 'required|string',
                'message' => 'required|string',
            ]);
    
            $apiUrl = env('WA_API')."/send";
    
            try {
                // Send POST request to the external API
                $response = Http::post($apiUrl, [
                    'number' => $request->input('number'),
                    'message' => $request->input('message'),
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
    public function doSendImage()
    {

    }
    

}
