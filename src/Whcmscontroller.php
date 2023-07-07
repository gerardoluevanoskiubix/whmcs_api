<?php

namespace whcms_api\whcms;

class WhcmsApi{
    public static function getclient(){
        return $this->getclientAsync();
    }

    public static function getclientAsync(){
        return 'holi';
    }
}

?>