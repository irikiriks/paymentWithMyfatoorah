<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class FatoorahServices
{

    private $base_url;
    private $headers;
    private $request_client;

    public function __construct(Client $request_client)
    {
        $this->request_client = $request_client;
        $this->base_url = env('fatoora_base_url');
        $this->headers = [
            'Content-Type' => 'application/json',
            'authorization' => 'Bearer ' . env('fatoorah_token')
        ];
    }


    private function buildRequest($uri, $method, $data = [])
    {

        $request = new Request($method, $this->base_url . $uri, $this->headers);
        if (!$data) {
            return false;
        }
        $response = $this->request_client->send($request, [
            'json' => $data
        ]);
        if ($response->getStatusCode() != 200) {
            return false;
        }
        $response = json_decode($response->getBody(), true);
        return $response;
    }



    public function sendPayment($data)
    {

        return $response = $this->buildRequest('v2/sendPayment', 'POST', $data);
    }


    // private function saveTransactionPayment($patient_id, $invoice_id)
    // {
    // }

    // public function transactionCallback($request)
    // {
    //     $data = $request->all();
    //     $status = strtolower($data['Data']['TransactionStatus']);
    // }


    public function getPaymentStatus($data)
    {

        return $response = $this->buildRequest('v2/getPaymentStatus', 'POST', $data);
    }
}
