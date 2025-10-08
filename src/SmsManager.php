<?php

namespace RihabRahman\BulkSmsBd;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsManager
{
    protected string $apiKey;
    protected string $senderId;

    public function __construct()
    {
        $this->apiKey = config('bulksmsbd.api_key');
        $this->senderId = config('bulksmsbd.sender_id');
    }

    /**
     * Send same message to one or many recipients
     */
    public function send(string $numbers, string $message)
    {
        $response = Http::asForm()->post('http://bulksmsbd.net/api/smsapi', [
            'api_key' => $this->apiKey,
            'senderid' => $this->senderId,
            'number' => $numbers,
            'message' => $message,
        ]);

        return $response->body(); // plain text code (e.g., 202)
    }

    /**
     * Send different messages to multiple numbers
     */
    public function sendBulk(array $messages)
    {
        $response = Http::asForm()->post('http://bulksmsbd.net/api/smsapimany', [
            'api_key' => $this->apiKey,
            'senderid' => $this->senderId,
            'messages' => json_encode($messages),
        ]);

        return $response->body();
    }

    /**
     * Check account balance
     */
    public function balance()
    {
        $response = Http::asForm()->post('http://bulksmsbd.net/api/getBalanceApi', [
            'api_key' => $this->apiKey,
        ]);

        return $response->body(); // balance or error code
    }
}
