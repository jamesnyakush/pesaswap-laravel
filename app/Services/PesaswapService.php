<?php

namespace App\Services;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

class PesaswapService
{
    /**
     * Create a new class instance.
     */
    public $base_url;

    public function __construct()
    {
        $this->base_url = env('PESASWAP_ENV') == 'live'
            ? 'https://www.pesaswap.com'
            : 'https://devpesaswap.azurewebsites.net';

        $this->base_url_csharp = env('PESASWAP_ENV') == 'live'
            ? 'https://api.pesaswap.com'
            : 'https://devpesaswap-csharp.azurewebsites.net';
    }

    public function tokenization()
    {
        $url = $this->base_url_csharp . '/api/tokenization';

        $data = [
            'ConsumerKey' => env('PESASWAP_CONSUMER_KEY'),
            'ApiKey' => env('PESASWAP_API_KEY'),
        ];

        $response = Http::post($url, $data);

        return $response->json('accessToken');
    }

    public function createCustomer($firstname, $lastname, $email, $phone, $address1, $address2, $state, $country, $external_id)
    {
        $url = $this->base_url . '/api/pesaswap/create/customer';

        $data = [
            'api_key' => env('PESASWAP_API_KEY'),
            'consumer_key' => env('PESASWAP_CONSUMER_KEY'),
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'phone' => $phone,
            'address1' => $address1,
            'address2' => $address2,
            'state' => $state,
            'country' => $country,
            'external_id' => $external_id,
            'environment' => env('PESASWAP_ENV'),
        ];

        $response = Http::post($url, $data);

        return $response->json();
    }

    public function cardPayment($currency, $amount, $expiry_date, $card_security_code, $credit_card_number, $external_id, $transaction_external_id)
    {
        $url = $this->base_url . '/api/regular/card-payment';

        $data = [
            'api_key' => env('PESASWAP_API_KEY'),
            'consumer_key' => env('PESASWAP_CONSUMER_KEY'),
            'currency' => $currency,
            'amount' => $amount,
            'expiry_date' => $expiry_date,
            'card_security_code' => $card_security_code,
            'credit_card_number' => $credit_card_number,
            'external_id' => $external_id,
            'transaction_external_id' => $transaction_external_id,
            'environment' => env('PESASWAP_ENV'),
        ];

        $response = Http::post($url, $data);

        return $response->json();
    }

    public function mpesaBalance()
    {
        $url = $this->base_url_csharp . '/api/balance';

        $response = Http::withHeaders([
            'MerchantIdentifier' => '867tLWWx0Pa4GyJ9ZcmSxRrIv',
            'Country' => 'KE',
            'Currency' => 'KES',
        ])->withToken($this->tokenization())->get($url);

        return $response->json();
    }

    public function collectionPayment()
    {
        $url = $this->base_url_csharp . '/api/collection-payment';

        $data = [
            'PaybillDescription' => 'PaybillDescription',
            'Country' => 'KE',
            'Currency' => 'KES',
            'Amount' => 1,
            'PhoneNumber' => '254714451234',
            'TransactionExternalId' => 'TransactionExternalId',
            'Comment' => 'Comment',
            'Processor' => 'mpesa',
        ];

        $response = Http::withToken($this->tokenization())->post($url,data: $data);

        return $response->json();
    }

}
