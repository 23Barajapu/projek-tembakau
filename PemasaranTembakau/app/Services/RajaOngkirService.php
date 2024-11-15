<?php

namespace App\Services;

use GuzzleHttp\Client;

class RajaOngkirService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.rajaongkir.com/starter/',
            'headers' => [
                'key' => env('RAJAONGKIR_API_KEY'),
            ]
        ]);
    }

    public function getProvince()
    {
        try {
            $response = $this->client->get('province');
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
    
    public function getCities($province_id)
    {
        try {
            $response = $this->client->get('city', [
                'query' => ['province' => $province_id]
            ]);
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function getCost($origin, $destination, $weight, $courier)
    {
        try {
            $response = $this->client->post('cost', [
                'form_params' => [
                    'origin' => $origin,
                    'destination' => $destination,
                    'weight' => $weight,
                    'courier' => $courier,
                ]
            ]);
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}