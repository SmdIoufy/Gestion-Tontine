<?php

namespace App\Services;

use GuzzleHttp\Client;

class PayTechService
{
    protected $client;
    protected $apiKey;
    protected $secretKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = config('paytech.api_key');
        $this->secretKey = config('paytech.secret_key');
        $this->baseUrl = config('paytech.base_url');
    }

    /**
     * Créer une demande de paiement
     *
     * @param array $data
     * @return array
     */
    public function createPayment(array $data)
    {
        try {
            $response = $this->client->post($this->baseUrl, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->apiKey,
                ],
                'form_params' => [
                    'item_name' => $data['item_name'],
                    'item_price' => $data['item_price'],
                    'currency' => $data['currency'],
                    'command_name' => $data['command_name'],
                    'notify_url' => $data['notify_url'],
                    'return_url' => $data['return_url'],
                    'cancel_url' => $data['cancel_url'],
                    'channels' => $data['channels'], // Ex: ['WAVE', 'OM']
                ]
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
        }
    }
}
