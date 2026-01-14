<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ChatController extends Controller
{
    private $apiKey;
    private $apiUrl;

    public function __construct()
    {
        $this->apiKey = env('GROQ_API_KEY');
        $this->apiUrl = 'https://api.groq.com/openai/v1/chat/completions';
    }

    public function index()
    {
        return view('chatbot.index');
    }

    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:5000',
        ]);

        try {
            $client = new Client();

            // Format request untuk Groq API (OpenAI-compatible)
            $response = $client->post($this->apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->apiKey,
                ],
                'json' => [
                    'model' => 'llama-3.3-70b-versatile', // Groq's fast model
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => 'Anda adalah asisten AI yang membantu menjawab pertanyaan tentang budaya Indonesia, wisata, kuliner, dan tradisi. Berikan jawaban yang informatif dan ramah.'
                        ],
                        [
                            'role' => 'user',
                            'content' => $validated['message']
                        ]
                    ],
                    'temperature' => 0.7,
                    'max_tokens' => 1024,
                ],
                'timeout' => 60,
            ]);

            $data = json_decode($response->getBody(), true);

            // Parse response dari Groq API (OpenAI-compatible format)
            if (isset($data['choices'][0]['message']['content'])) {
                $content = $data['choices'][0]['message']['content'];
                $content = trim($content);
                
                return response()->json([
                    'success' => true,
                    'response' => $content,
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'error' => 'Respons API tidak valid',
                ], 400);
            }
        } catch (GuzzleException $e) {
            $errorMessage = $e->getMessage();
            
            // Handle specific Groq API errors
            if ($e->hasResponse()) {
                $responseBody = json_decode($e->getResponse()->getBody(), true);
                if (isset($responseBody['error']['message'])) {
                    $errorMessage = $responseBody['error']['message'];
                }
            }
            
            return response()->json([
                'success' => false,
                'error' => 'Terjadi kesalahan: ' . $errorMessage,
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}

