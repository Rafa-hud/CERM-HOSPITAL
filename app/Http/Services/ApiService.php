<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ApiService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => env('FLASK_API_URL', 'http://127.0.0.1:5000'),
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('FLASK_API_TOKEN', ''),
            ],
            'timeout' => 15.0,
            'http_errors' => false
        ]);
    }

    public function get($endpoint, $params = [])
    {
        try {
            $response = $this->client->get($endpoint, ['query' => $params]);

            return [
                'success' => $response->getStatusCode() === 200,
                'data' => json_decode($response->getBody()->getContents(), true),
                'status' => $response->getStatusCode()
            ];
        } catch (RequestException $e) {
            return [
                'success' => false,
                'data' => ['message' => $e->getMessage()],
                'status' => $e->getCode()
            ];
        }
    }
}
