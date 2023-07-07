<?php

namespace WhcmsApi\Whcms;

class whcms_api{
    public static function getclient(){
        return $this->getclientAsync();
    }

    public static function getclientAsync(){
        return 'holi';
    }
}

?>