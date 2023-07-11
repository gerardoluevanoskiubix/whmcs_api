<?php
/**
 * WHCMS Setting & API Credentials
 * Created by Gerardo Luevanos <gerardo.luevanos01@gmail.com>.
 *
return [
    'mode'    => env('WHCMS_MODE', 'sandbox'), // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'url'                 => env('WHCMS_SANDBOX_URL',''),
        'identifier'          => env('WHCMS_SANDBOX_IDENTIFIER', ''),
        'secret'              => env('WHCMS_SANDBOX_SECRET', ''),
        'url_path'            => env('WHCMS_SANDBOX_URL_PATH',''),
        'brand_id'            => env('WHCMS_SANDBOX_BRAND_ID',''),
    ],
    'live' => [
        'url'                 => env('WHCMS_LIVE_URL',''),
        'identifier'          => env('WHCMS_LIVE_IDENTIFIER', ''),
        'secret'              => env('WHCMS_LIVE_SECRET', ''),
        'product_one_adminit' => env('WHCMS_LIVE_PRODUCT_ONE_ADMINIT', ''),
        'url_path'            => env('WHCMS_LIVE_URL_PATH',''),
        'brand_id'            => env('WHCMS_LIVE_BRAND_ID',''),
    ],
];

*/
