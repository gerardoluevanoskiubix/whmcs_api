<?php

namespace WhcmsApi;

class WhcmsApi{
    public function getclient(){
        return $this->getclientAsync();
    }

    public function getclientAsync(){
        return 'holi';
    }
}
