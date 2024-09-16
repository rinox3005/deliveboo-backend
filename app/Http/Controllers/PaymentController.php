<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree\Gateway;

class PaymentController extends Controller
{
    private $gateway;

    public function __construct()
    {
        // Utilizza le variabili di configurazione definite nel file config/services.php
        $this->gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey'),
        ]);
    }

    public function generateToken()
    {
        try {
            // Utilizza il gateway già configurato nel costruttore
            $clientToken = $this->gateway->clientToken()->generate();

            return response()->json(['token' => $clientToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Errore nel generare il token: ' . $e->getMessage()], 500);
        }
    }

    public function processPayment(Request $request)
    {
        $nonce = $request->input('payment_method_nonce');
        $amount = $request->input('amount');

        try {
            $result = $this->gateway->transaction()->sale([
                'amount' => $amount,
                'paymentMethodNonce' => $nonce,
                'options' => [
                    'submitForSettlement' => true
                ]
            ]);

            if ($result->success) {
                return response()->json(['success' => true, 'transaction_id' => $result->transaction->id]);
            } else {
                return response()->json(['success' => false, 'message' => $result->message], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Errore nel processare il pagamento: ' . $e->getMessage()], 500);
        }
    }
}
