<?php namespace Operation;

use DBConnection;
use ServiceAuthentication;

class transfer{
    private $srcNumber,$srcName;

    public function __construct(string $srcNumber,string $srcName){
        $this->srcNumber = $srcNumber;
        $this->srcName = $srcName;
    }


    public function doTransfer(string $targetNumber, string $amount){
        $response["isError"] = true;
        $response["message"] = "ยอดเงินในบัญชีไม่เพียงพอ";
        try {
            $response = ServiceAuthentication::accountAuthenticationProvider($targetNumber);
            $response["isError"] = false;
            $response["message"] = "";
            echo $response;
            echo "test";
            } catch(Error $e) {
                $response["message"] = "Unknown error occurs in Transfer";
            }

      return $response;
    }
}


