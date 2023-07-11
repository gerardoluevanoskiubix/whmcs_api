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
 * Created by Gerardo Luevanos <gerardo.luevanos@kiubix.com>.
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
<a name="support"></a>
## Support
*gerardo.luevanos@kiubix.com

<a name="support"></a>
## Examples

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
    $user = $whcms->validatelogin($config,$user);
    /*** 
     * if response in json is true return:
     * "ststus" => bool - true or false,
     * "message" => "status of callback",
     * 
     * if response in json is false return:
     * boolval true or false
     * 
 ```

 ```php
    //This is an example to create cleint
    //Initialice method
    $whcms = new \WhcmsApi\WhcmsApi();
    //Obtain config status, sandbox or live
    $mode = config('whcms.mode');
    //Obtain config in this mode
    $config = config("whcms.{$mode}");
    // Create array with user info
    $user = [
        'firstname' => 'Gerardo',
        'lastname' => 'Luevanos',
        'email' => 'gerardo.luevanos@kiubix.com',
        'address1' => 'Aguascalientes',
        'city' => 'Aguascalientes',
        'state' => 'Aguascalientes',
        'postcode' => '20030',
        //US or MX
        'country' => 'US',
        'phonenumber' => '4494022719'
        'noemail' => true,
        //search brand id in WHM production before add in this setting
        'brand_id' => 1,
    ];
    //send to get callback
    $response = $whcms->createclient($config,$user);
    dd($response);
 ```

```php
    //This is an example to get client info
    //Initialice method
    $whcms = new \WhcmsApi\WhcmsApi();
    //Obtain config status, sandbox or live
    $mode = config('whcms.mode');
    //Obtain config in this mode
    $config = config("whcms.{$mode}");
    $email = 'gerardo.luevanos@kiubix.com';
    //send to get callback
    $response = $whcms->getclient($config,$email);
    dd($response);
```

```php
    //This is an example to recovery password to user
    //Initialice method
    $whcms = new \WhcmsApi\WhcmsApi();
    //Obtain config status, sandbox or live
    $mode = config('whcms.mode');
    //Obtain config in this mode
    $config = config("whcms.{$mode}");
    $email = 'gerardo.luevanos@kiubix.com';
    //send to get callback
    $response = $whcms->recoverypasssword($config,$email);
    dd($response);
```


```php
    //This is an example to add order to user
    //Initialice method
    $whcms = new \WhcmsApi\WhcmsApi();
    //Obtain config status, sandbox or live
    $mode = config('whcms.mode');
    //Obtain config in this mode
    $config = config("whcms.{$mode}");
    //Create array order
    $order = [
        //Client id to add order
        'clientid' => 1,
        //Product id to add
        'pid' => 1,
        /*** Addons is in list, not array for example
         * addons => '1,4,2,6'    - This is correct
         * addons => [1,4,2,6]    - This is incorrect 
         * */
        'addons' => '1,2,3',
        'domain' => 'gerardoluevanos.com',
        'billingcycle' => 'anually',
        'paymentmethod' => 'paypal',
        //To don't send email
        'noemail' => true,
        /*** This action create invoicer automatically
         * To not send email with information send in true
         * To send email switch to false
         * */
        'noinvoiceemail' => true,
        'brand_id' => 1,
    ];
    //send to get callback
    $response = $whcms->addorder($config,$order);
    dd($response);
```

```php
    //This is an example to get invoice info
    //Initialice method
    $whcms = new \WhcmsApi\WhcmsApi();
    //Obtain config status, sandbox or live
    $mode = config('whcms.mode');
    //Obtain config in this mode
    $config = config("whcms.{$mode}");
    //id invoice to get information
    $invoice = 10;
    //send to get callback
    $response = $whcms->getinvoice($config,$invoice);
    dd($response);
```

```php
    //This is an example to add invoice payment
    //Initialice method
    $whcms = new \WhcmsApi\WhcmsApi();
    //Obtain config status, sandbox or live
    $mode = config('whcms.mode');
    //Obtain config in this mode
    $config = config("whcms.{$mode}");
    //Create object invoice
    $invoice = [
        'id' => 1,
        //Transid is provided in callback of your provider, en example: paypal, mercadopago, conekta
        'transid' => 'asd4asd76as57d9asd87a968s7d68a7sd687asd',
        'gateway' => 'paypal',
        'date' => '28-11-1997', //Date to create transaction
        'noemail' => true, //To dont send email notifcation
    ];
    //send to get callback
    $response = $whcms->addinvoicepayment($config,$invoice);
    dd($response);
```



```php
    //This is an example to create quote
    //Initialice method
    $whcms = new \WhcmsApi\WhcmsApi();
    //Obtain config status, sandbox or live
    $mode = config('whcms.mode');
    //Obtain config in this mode
    $config = config("whcms.{$mode}");
    //Create object invoice
    $quote => [
        'subject' => 'Quote for get product by Gerardo - 28-11-1997',
        'user_id' => 1, //Id user to add quote,
        'date_created' => '28-11-1997',
        'validuntil' => '28-12-1997', // Date to expired this quote
        'array_items_quote' => [
            ["desc"=>"Test Description 1","qty"=>1,"up"=>"10.00","discount"=>"10.00","taxable"=>true],
            ["desc"=>"Test Description 2","qty"=>2,"up"=>"20.00","discount"=>"10.00","taxable"=>true]
        ];
    ];
    //send to get callback
    $response = $whcms->createquote($config,$quote);
    dd($response);
```
