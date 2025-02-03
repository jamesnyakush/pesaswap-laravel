<?php

use App\Services\PesaswapService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/create-customer', function () {

    return (new PesaswapService())->createCustomer(
        'James',
        'Nyakush',
        'alex2@gmail.com',
        '+254746445198',
        'Monrovia street',
        'utalii street',
        'Nairobi',
        'Kenya',
        Str::uuid()->toString()
    );
});


Route::post('/card-payment', function () {

    return (new PesaswapService())->cardPayment(
        'KES',
        1,
        '012027',
        '111',
        '5200000000000007',
        '5e50f7c4-0f84-45d5-b735-2011124ddc4b',
        'CjsU44Drz2fNka7SetRb6ZrHy'
    );
});

Route::post('/tokenization', function () {

    return (new PesaswapService())->tokenization();
});

Route::post('/collection-payment', function () {

    return (new PesaswapService())->collectionPayment();
});

Route::get('/mpesa-balance', function () {
    return (new PesaswapService())->mpesaBalance();
});

