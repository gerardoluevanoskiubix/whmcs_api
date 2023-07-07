<?php

namespace whcms_api\whcms;

class whcms_api{
    public static function getclient(){
        return $this->getclientAsync();
    }

    public static function getclientAsync(){
        return 'holi';
    }
}

?>