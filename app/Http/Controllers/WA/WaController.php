<?php

namespace App\Http\Controllers\WA;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;         
use Illuminate\Http\Response; 
use App\Helpers\H1BHelper;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class WaController extends Controller
{
    public function Settings()
    {
        $config = [
            'page'   => [
                'title' => 'WA Settings',
                'description' => 'WA Settings - Description',
                'name' => 'WA Settings - Notification',
                'parent' => 'WA',
                'author' => 'Telcomixo',
            ],
        ];

        return view('PanelAdmin.WA.settings',compact('config'));
    }
    
    public function sendMessage(request $request, response $response)
    {
        // Get inputs from the request
        $message  = $request->input('message');
        $phone_no = $request->input('phone_no');
        $api_url  = env('WA_API').'/send';  // Adjust your API URL
       // print_r($api_url);
        //exit();

        $phone_no = str_replace(['+', '-',' '], '', trim($phone_no));
        //print_r($phone_no);
        //exit();
        // Validate inputs
        if (empty($message) || empty($phone_no)) {
            return response()->json(['result'=>'failed','error' => 'Phone number and message are required.'], 400);
        }

        // Prepare the data
        $data = [
            'number'  => $phone_no,
            'message' => $message,
        ];

        try {
            // Send POST request with JSON data
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($api_url, $data);

            // Check for success and handle the response
            if ($response->successful() && $response->json('success')) {
                $success_message = "Message sent successfully! Message ID: " . $response->json('messageId');
                //print_r($response);
                //exit();
                // return response()->json(['result'=>'success','message' => $success_message], 200);
            } else {
                //print_r('error');
                //print_r($response);
                //exit();
                $error_message = $response->json('error') ?? 'Failed to send message. Please try again.';
                return response()->json(['result'=>'failed','error' => $error_message], 500);
            }
        } catch (\Exception $e) {
            // Handle any exceptions that might occur
            return response()->json(['result'=>'failed','error' => 'An error occurred: ' . $e->getMessage()], 500);
        }

    }

    public function getChatHistory($phoneNumber)
    {
        $apiUrl = env('WA_API')."/chat-history/{$phoneNumber}";

        try {
            // Send GET request to the external API
            $response = Http::get($apiUrl);

            // Check for successful response
            if ($response->successful()) {
                $this->data =  response()->json([
                    'success' => true,
                    'data' => $response->json(),
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch chat history.',
            ], $response->status());
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}