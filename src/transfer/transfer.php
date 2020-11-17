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

        
        // $response = ServiceAuthentication::accountAuthenticationProvider($targetNumber);
        // $test = ServiceAuthentication::accountAuthenticationProvider($targetNumber);
        // echo 'haha' $test;
        // try {
        //     $test = ServiceAuthentication::accountAuthenticationProvider($targetNumber);
        //     echo $test;
        //     $response["isError"] = false;
        //     $response["message"] = "gg";
        //     } 
        //     catch(Error $e) {
        //         echo "errordadsadadadad";
        //         $response["message"] = "Unknown error occurs in Transfer";
        //     }
        return $response;
    }
}


