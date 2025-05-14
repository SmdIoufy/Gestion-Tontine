<?php

return [
    'api_key' => env('PAYTECH_API_KEY', ''),
    'secret_key' => env('PAYTECH_SECRET_KEY', ''),
    'base_url' => env('PAYTECH_BASE_URL', 'https://paytech.sn/api/payment/request-payment'),
];
