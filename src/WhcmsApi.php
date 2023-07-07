<?php

namespace WhcmsApi;

class WhcmsApi{

    public function validateconfigbeforecontinue(array $config){
        try{
            if(is_array($config)){
                $keysToCheck = ['url', 'identifier', 'secret', 'url_path'];
                $containsAllKeys = true;
                foreach ($keysToCheck as $key) {
                    if (!array_key_exists($key, $arr['sandbox'])) {
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

    public function getclient(array $config,$response_in_array = false,array $client){
       $continue = $this->validateconfigbeforecontinue($config);
       if($continue && is_array($client)){
            return $this->getclientAsync($config,$client);
       }else{
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

    public function getclientAsync($config,$user){
        return $user;
    }
}
