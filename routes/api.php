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

    return (new PesaswapService())->collectionPayment(
        'KE',
        'KES',
        1,
        '012027',
        '5e50f7c4-0f84-45d5-b735-2011124ddc4b',
        '5e50f7c4-0f84-45d5-b735-2011124ddc4b',
        'mpesa'
    );
});

Route::post('/mpesa-c2b-billrefno', function () {

    return (new PesaswapService())->mpesaC2bBillRefNo(
        'zzzz',
        1,
        'CustomerPayBillOnline',
        '174379',
        '123445',
        '174379',
        'kkdk'
    );
});

Route::post('/reconcile-transaction', function () {
    return (new PesaswapService())->reconcileTransaction(
        '2021-08-01',
    );
});

Route::post('/refund', function () {
    return (new PesaswapService())->refund(
        '333',
        '1234567890',
        ''
    );
});

Route::post('/payment-request', function () {
    return (new PesaswapService())->paymentRequest(
        '1234567890',
        'njhbhjbjh',
        1,
        'dafwedewd',
        '211/11/1111',
        '1234567890',
        1
    );
});

Route::post('/payment-request-recurring', function () {
    return (new PesaswapService())->paymentRequestRecurringBill(
        '1234567890',
        'njhbhjbjh',
        1,
        'dafwedewd',
        '211/11/1111',
        '1234567890',
        23
    );
});

Route::post('/airtel-collection', function () {
    return (new PesaswapService())->airtelCollection(
        '1234567890',
        'njhbhjbjh',
        '0987777779',
        1,
    );
});

Route::post('/balance-summary', function () {
    return (new PesaswapService())->balanceSummary(
        '1234567890',
        'njhbhjbjh',
        '0987777779',
    );
});

Route::post('/wallet-mpesa-lipa', function () {
    return (new PesaswapService())->walletMpesaLipa(
        '1234567890',
        'njhbhjbjh',
        '0987777779',
        '22222',
        'alsdjknwdknfkinkncjwendn'
    );
});

Route::post('/wallet-mpesa-b2c', function () {
    return (new PesaswapService())->walletMpesaB2c(
        '1234567890',
        'njhbhjbjh',
        '0987777779',
        '22222',
        'alsdjknwdknfkinkncjwendn'
    );
});

Route::get('/mpesa-balance', function () {
    return (new PesaswapService())->mpesaBalance();
});

