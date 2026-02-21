<?php

use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\InvoiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get(uri: '/user', action: function (Request $request): mixed {
    return $request->user();
})->middleware(middleware: 'auth:sanctum');

Route::group(attributes: ["prefix" => "v1", "namespace" => "App\Http\Controllers\Api\V1"], routes: function () {
    Route::apiResource("customers", CustomerController::class);
    Route::apiResource("invoices", InvoiceController::class);
});
