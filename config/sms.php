<?php

return [
    'driver' => env('SMS_DRIVER', 'flowroute'),
    'access_key' => env('SMS_ACCESS_KEY'),
    'secret_key' => env('SMS_SECRET_KEY'),
    'from' => env('SMS_FROM'),
    'sender_supported' => env('SMS_SENDER_SUPPORTED', false),
];