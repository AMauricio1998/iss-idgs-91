<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class PaymentController extends Controller
{
    private $client;
    private $clientId;
    private $secret;

    public function __construct() {
        $this->client = new Client([
            'base_uri' => 'https://api-m.sandbox.paypal.com'
        ]);

        $this->clientId = env('PAYPAL_CLIENT_ID');
        $this->secret = env('PAYPAL_SECRET');
    }

    private function getAccessToken() {
        $response =  $this->client->request('POST', '/v1/oauth2/token/', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'body' => 'grant_type=client_credentials',
            'auth' => [
                $this->clientId, $this->secret, 'basic'
            ]
        ]);
        $data = json_decode($response->getBody(), true);
        return $data['access_token'];
    }

    public function process($orderId, Request $request) {
        $accessToken = $this->getAccessToken();
        $requestUrl = "/v2/checkout/orders/$orderId/capture";

        $response = $this->client->request('POST', $requestUrl, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer $accessToken"
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        if ($data['status'] === 'COMPLETED') {
            
            try {
                $userId = Auth::user()->id;
                $amount = $data['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
                $payPalPaymentId = $data['purchase_units'][0]['payments']['captures'][0]['id'];
                $user = User::findOrFail(Auth::user()->id);

                Payment::create([
                    'id_user' => $userId,
                    'monto' => $amount,
                    'paypal_order_id' => $payPalPaymentId,
                ]);

                return response()->json([
                    'success' => true,
                    'payPalPaymentId' => $payPalPaymentId,
                    'amount' => $amount,
                    'user' => $user
                ]);
            } catch (\Throwable $error) {
                return response()->json([
                    'msg' => 'hubo un error'
                ]);
            }
        } 
        
        return response()->json([
            'msg' => 'Pago no completo, intentalo mas tarde'
        ]);
    }
}