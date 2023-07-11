<?php

namespace WhcmsApi;

class WhcmsApi{

    public function validatelogin(array $config,$response_in_array = true,array $user){
       $continue = $this->validateconfigbeforecontinue($config);
       if($continue && is_array($user)){
            return $this->validateloginAsync($config,$response_in_array,$user);
       }else{
        if($response_in_array){
            $res = array(
                "status" => false,
                'message' => "The config user is not valid"
            );
            return $res;
        }else{
            return false;
        }
       }
    }

    public function createclient(array $config,$response_in_array = true,array $user){
        $continue = $this->validateconfigbeforecontinue($config);
        if($continue && is_array($user)){
             return $this->createclientAsyc($config,$response_in_array,$user);
        }else{
         if($response_in_array){
             $res = array(
                 "status" => false,
                 'message' => "The config user is not valid"
             );
             return $res;
         }else{
             return false;
         }
        }
    }

    public function getclient(array $config,$response_in_array = true,$email){
        $continue = $this->validateconfigbeforecontinue($config);
        if($continue && $email){
             return $this->getclientAsync($config,$response_in_array,$email);
        }else{
         if($response_in_array){
             $res = array(
                 "status" => false,
                 'message' => "The config user is not valid"
             );
             return $res;
         }else{
             return false;
         }
        }  
    }

    public function resetpassword(array $config,$response_in_array = true,$email){
        $continue = $this->validateconfigbeforecontinue($config);
        if($continue && $email){
             return $this->recoverypassswordAsync($config,$response_in_array,$email);
        }else{
         if($response_in_array){
             $res = array(
                 "status" => false,
                 'message' => "The config user is not valid"
             );
             return $res;
         }else{
             return false;
         }
        } 
    }

    public function addorder(array $config,$response_in_array = true,array $order){
        $continue = $this->validateconfigbeforecontinue($config);
        if($continue && is_array($order)){
             return $this->addorderAsync($config,$response_in_array,$order);
        }else{
         if($response_in_array){
             $res = array(
                 "status" => false,
                 'message' => "The config order is not valid"
             );
             return $res;
         }else{
             return false;
         }
        } 
    }

    public function getinvoice(array $config,$response_in_array = true,$invoice){
        $continue = $this->validateconfigbeforecontinue($config);
        if($continue && $invoice){
             return $this->getinvoiceAsync($config,$response_in_array,$order);
        }else{
         if($response_in_array){
             $res = array(
                 "status" => false,
                 'message' => "The config order is not valid"
             );
             return $res;
         }else{
             return false;
         }
        } 
    }

    public function addinvoicepayment(array $config,$response_in_array = true,array $invoice){
        $continue = $this->validateconfigbeforecontinue($config);
        if($continue && is_array($order)){
             return $this->addinvoicepaymentAsync($config,$response_in_array,$order);
        }else{
         if($response_in_array){
             $res = array(
                 "status" => false,
                 'message' => "The config order is not valid"
             );
             return $res;
         }else{
             return false;
         }
        } 
    }
    
    public function createquote(array $config,$response_in_array = true,array $quote){
        $continue = $this->validateconfigbeforecontinue($config);
        if($continue && is_array($quote)){
             return $this->createquoteAsync($config,$response_in_array,$quote);
        }else{
         if($response_in_array){
             $res = array(
                 "status" => false,
                 'message' => "The config quote is not valid"
             );
             return $res;
         }else{
             return false;
         }
        } 
    }

    public function validateloginAsync($config,$response_in_array,$user){
        $query = http_build_query(
                    array(
                        'action' => 'ValidateLogin',
                        'username' => $config['identifier'],
                        'password' => $config['secret'],
                        'email' => $user['email'],
                        'password2' => $user['password'],
                        'responsetype' => 'json',
                    )
                );
        return $this->sendrequestandmethod($config,$response_in_array,$query);
    }

    public function createclientAsyc($config,$response_in_array,$user){
        $query = http_build_query(
                    array(
                        'action' => 'AddClient',
                        'username' => $config['identifier'],
                        'password' => $config['secret'],
                        'firstname' => $user['firstname'],
                        'lastname' => $user['lastname'],
                        'email' => $user['email'],
                        'address1' => $user['address1'],
                        'city' => $user['city'],
                        'state' => $user['state'],
                        'postcode' => $user['postcode'],
                        'country' => $user['country'],
                        'language' => $user['language'],
                        'phonenumber' => $user['phonenumber'],
                        'password2' => $user['password2'],
                        'responsetype' => 'json',
                        'noemail' => $user['noemail'],
                        'groupid' => $config['brand_id'],
                    )
                );
        return $this->sendrequestandmethod($config,$response_in_array,$query);     
    }

    public function getclientAsync($config,$response_in_array,$email){
        $query = http_build_query(
                    array(
                        'action' => 'GetClients',
                        'username' => $config['identifier'],
                        'password' => $config['secret'],
                        'search' => $email,
                        'responsetype' => 'json',
                    )
                );

        return $this->sendrequestandmethod($config,$query);   
    }

    public function recoverypassswordAsync($config,$response_in_array,$email){
        $query = http_build_query(
                    array(
                        'action' => 'ResetPassword',
                        'username' => $config['identifier'],
                        'password' => $config['secret'],
                        'email' => $email,
                        'responsetype' => 'json',
                    )
                );
        return $this->sendrequestandmethod($config,$response_in_array,$query);
    }

    public function addorderAsync($config,$response_in_array,$order){
        $query = http_build_query(
                    array(
                        'action' => 'AddOrder',
                        'username' => $config['identifier'],
                        'password' => $config['secret'],
                        'clientid' => $order['clientid'],
                        'pid' => $order['pid'],
                        'addons' => $order['addons'],
                        'domain' => $order['domain'],
                        'billingcycle' => $order['billingcycle'],
                        'paymentmethod' => $order['paymentmethod'],
                        'responsetype' => 'json',
                        'noemail' => $order['noemail'],
                        'noinvoiceemail' => $order['noinvoiceemail'],
                        'brandid' => $config['brand_id'],
                    )
                );
        return $this->sendrequestandmethod($config,$response_in_array,$query);
    }

    public function getinvoiceAsync($config,$response_in_array,$invoice){
        $query = http_build_query(
                    array(
                        'action' => 'GetInvoice',
                        'username' => $config['identifier'],
                        'password' => $config['secret'],
                        'invoiceid' => $invoice,
                        'responsetype' => 'json',
                    )
                );
        return $this->sendrequestandmethod($config,$response_in_array,$query);
    }

    public function addinvoicepaymentAsync($config,$response_in_array,$invoice){
        $query = http_build_query(
                    array(
                        'action' => 'AddInvoicePayment',
                        'username' => $config['identifier'],
                        'password' => $config['secret'],
                        'invoiceid' => $invoice['id'],
                        'transid' => $invoice['transid'],
                        'gateway' => $invoice['gateway'],
                        'date' => $invoice['date'],
                        'noemail' => $invoice['noemail'],
                        'responsetype' => 'json',
                    )
                );
        return $this->sendrequestandmethod($config,$response_in_array,$query);
    }

    public function createquoteAsync($config,$response_in_array,$quote){
        $query = ttp_build_query(
                    array(
                        'action' => 'CreateQuote',
                        'username' => $config['identifier'],
                        'password' => $config['secret'],
                        'subject' => $quote['subject'],
                        'stage' => 'Draft',
                        'userid' => $quote['user_id'],
                        'datecreated' => $quote['date_created'],
                        'validuntil' => $quote['dateuntil'],
                        'lineitems' => base64_encode(serialize($quote['array_items_quote'])),
                        'responsetype' => 'json',
                    )
                );
        return $this->sendrequestandmethod($config,$response_in_array,$query);
    }

    public function sendrequestandmethod($config,$response_in_array,$query){
        try{
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $config['url']);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$query);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);
            $response_in_json = json_decode($response);
            if($response_in_json->result == 'success'){
                if($response_in_array){
                    $res = $response_in_json;
                    return $res;
                }else{
                    return true;
                }
            }elseif($response_in_json->result == 'error'){
                if($response_in_array){
                    $res = $response_in_json;
                    return $res;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }catch(Exception $e){
            if($response_in_array){
                $res = array(
                    "status" => false,
                    'message' => "The config client is not valid"
                );
                return $res;
            }else{
                return false;
            }
        }
    }
    
    public function validateconfigbeforecontinue(array $config){
        try{
            if(is_array($config)){
                $keysToCheck = ['url', 'identifier', 'secret', 'url_path'];
                $containsAllKeys = true;
                foreach ($keysToCheck as $key) {
                    if (!array_key_exists($key, $config)) {
                        $containsAllKeys = false;
                        break;
                    }
                }
                if ($containsAllKeys) {
                    return true;
                } else {
                    return false;
                }
            }else{
                return false;
            } 
        }catch(Exception $e){
            return $e;
        }
    }
}
