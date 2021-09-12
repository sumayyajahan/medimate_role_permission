<?php

// SSLCommerz configuration

return [
    'projectPath' => env('PROJECT_PATH'),
    // For Sandbox, use "https://sandbox.sslcommerz.com"
    // For Live, use "https://securepay.sslcommerz.com"
    // 'apiDomain' => env("API_DOMAIN_URL", "https://sandbox.sslcommerz.com"),
    'apiDomain' => env("API_DOMAIN_URL", "https://securepay.sslcommerz.com"),
    'apiCredentials' => [
        // 'store_id' => env("STORE_ID", 'medim5fb7e881a0f58'),
        // 'store_password' => env("STORE_PASSWORD", 'medim5fb7e881a0f58@ssl'),
        'store_id' => env("STORE_ID", 'medimatehealthlive'),
        'store_password' => env("STORE_PASSWORD", '606BF037A3A0968586'),
    ],
    'apiUrl' => [
        'make_payment' => "/gwprocess/v4/api.php",
        'transaction_status' => "/validator/api/merchantTransIDvalidationAPI.php",
        'order_validate' => "/validator/api/validationserverAPI.php",
        'refund_payment' => "/validator/api/merchantTransIDvalidationAPI.php",
        'refund_status' => "/validator/api/merchantTransIDvalidationAPI.php",
    ],
    'connect_from_localhost' => env("IS_LOCALHOST", true), // For Sandbox, use "true", For Live, use "false"
    'success_url' => '/success',
    'failed_url' => '/fail',
    'cancel_url' => '/cancel',
    'ipn_url' => '/ipn',
];
