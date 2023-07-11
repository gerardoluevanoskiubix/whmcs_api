<?php

namespace WhcmsApi;

class WhcmsApi{

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

    public function validatelogin(array $config,$response_in_array = false,array $user){
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

    public function validateloginAsync($config,$response_in_array,$user){
        try{
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $config['url']);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,
                http_build_query(
                    array(
                        'action' => 'ValidateLogin',
                        'username' => $config['identifier'],
                        'password' => $config['secret'],
                        'email' => $user['email'],
                        'password2' => $user['password'],
                        'responsetype' => 'json',
                    )
                )
            );
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
}
