<?php

use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\InvoiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get(uri: '/user', action: function (Request $request): mixed {
    return $request->user();
})->middleware(middleware: 'auth:sanctum');

Route::group(attributes: ["prefix" => "v1", "namespace" => "App\Http\Controllers\Api\V1"], routes: function (): void {
    Route::apiResource(name: "customers", controller: CustomerController::class);
    Route::apiResource(name: "invoices", controller: InvoiceController::class);

    Route::post(uri: "invoices/bulk", action: ["uses" => "InvoiceController@bulkStore"]);
});
