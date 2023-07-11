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
        return $this->sendrequestandmethod($config,$query);     
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
        return $this->sendrequestandmethod($config,$query);
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
