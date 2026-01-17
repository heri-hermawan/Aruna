<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

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

        } catch (ClientException $e) {
            // Handle 4xx errors (Bad Request, Unauthorized, Forbidden, etc)
            $errorMessage = 'API Error: ';
            
            if ($e->hasResponse()) {
                $statusCode = $e->getResponse()->getStatusCode();
                $responseBody = json_decode($e->getResponse()->getBody(), true);
                
                if (isset($responseBody['error']['message'])) {
                    $errorMessage .= $responseBody['error']['message'];
                } else {
                    $errorMessage .= $e->getMessage();
                }
                
                // Handle specific error codes
                if ($statusCode === 401) {
                    $errorMessage = 'API Key tidak valid. Periksa konfigurasi GROQ_API_KEY.';
                } elseif ($statusCode === 429) {
                    $errorMessage = 'Terlalu banyak request. Silakan coba lagi nanti.';
                }
            } else {
                $errorMessage .= $e->getMessage();
            }
            
            return response()->json([
                'success' => false,
                'error' => $errorMessage,
            ], $e->getCode() ?: 400);
            
        } catch (ServerException $e) {
            // Handle 5xx errors (Internal Server Error, Bad Gateway, etc)
            $errorMessage = 'Server Groq mengalami masalah: ';
            
            if ($e->hasResponse()) {
                $responseBody = json_decode($e->getResponse()->getBody(), true);
                
                if (isset($responseBody['error']['message'])) {
                    $errorMessage .= $responseBody['error']['message'];
                } else {
                    $errorMessage .= $e->getMessage();
                }
            } else {
                $errorMessage .= $e->getMessage();
            }
            
            return response()->json([
                'success' => false,
                'error' => $errorMessage,
            ], $e->getCode() ?: 500);
            
        } catch (ConnectException $e) {
            // Handle connection errors (timeout, DNS failure, network issues)
            return response()->json([
                'success' => false,
                'error' => 'Tidak dapat terhubung ke server Groq. Periksa koneksi internet Anda.',
            ], 503);
            
        } catch (RequestException $e) {
            // Handle other request-related errors
            $errorMessage = 'Request error: ';
            
            if ($e->hasResponse()) {
                $responseBody = json_decode($e->getResponse()->getBody(), true);
                
                if (isset($responseBody['error']['message'])) {
                    $errorMessage .= $responseBody['error']['message'];
                } else {
                    $errorMessage .= $e->getMessage();
                }
            } else {
                $errorMessage .= $e->getMessage();
            }
            
            return response()->json([
                'success' => false,
                'error' => $errorMessage,
            ], 500);
            
        } catch (\Exception $e) {
            // Catch-all for any other unexpected errors
            return response()->json([
                'success' => false,
                'error' => 'Terjadi kesalahan tidak terduga: ' . $e->getMessage(),
            ], 500);
        }
    }
}