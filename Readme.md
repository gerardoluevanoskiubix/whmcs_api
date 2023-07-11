# Laravel WHMCS Rest API
    
<a name="introduction"></a>
## Documentation / Usage

```php
// Import the class namespaces first, before using it directly
use whcms_api\whcms\src\WhcmsApi;

$whcms = new \WhcmsApi\WhcmsApi();

```

<a name="usage-paypal-api-configuration"></a>
## Configuration File

The configuration file **whcms.php** is located in the **config** folder. Following are its contents when published:

```php
<?php
/**
 * WHCMS Setting & API Credentials
 * Created by Gerardo Luevanos <gerardo.luevanos01@gmail.com>.
 */
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
```

 ```php
    //This is an example to valdate login

    //Initialice method
    $whcms = new \WhcmsApi\WhcmsApi();
    //Obtain config status, sandbox or live
    $mode = config('whcms.mode');
    //Obtain config in this mode
    $config = config("whcms.{$mode}");
    //Create array with information of user to validate login
    $user = array(
        "email" => '********',
        "password" => '****'
    );
    //Send data to callback
    //Send config,response_in_json is default false, change true for false to return bool val, include user config
    $user = $whcms->validatelogin($config,true,$user);
    /*** 
     * if response in json is true return:
     * "ststus" => bool - true or false,
     * "message" => "status of callback",
     * 
     * if response in json is false return:
     * boolval true or false
     * 
 ```

<a name="support"></a>
## Support
*gerardo.luevanos01@gmail.com