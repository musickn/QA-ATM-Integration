<?php namespace Operation;

use DBConnection;
use ServiceAuthentication;

function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

class transfer{
    private $srcNumber,$srcName;

    public function __construct(string $srcNumber,string $srcName){
        $this->srcNumber = $srcNumber;
        $this->srcName = $srcName;
    }

    public function doTransfer(string $targetNumber, string $amount){

      $response["isError"] = true;
      $response["message"] = "ยอดเงินในบัญชีไม่เพียงพอ";
      console_log("hhhhh");
      echo "hahaah";

    //   if($bill_type == 'waterCharge'){
    //     if($this->acctInfo['accBalance'] >= $this->acctInfo['accWaterCharge']) {
    //       $updatedBalance = $this->acctInfo['accBalance'] - $this->acctInfo['accWaterCharge'];

    //       try{
    //         DBConnection::saveTransaction($this->acctInfo['accNo'], $updatedBalance);
    //         DBConnection::saveTransactionWaterCharge($this->acctInfo['accNo'], 0);

    //         $response = ServiceAuthentication::accountAuthenticationProvider($this->acctInfo['accNo']);
    //         $response["isError"] = false;
    //         $response["message"] = "";
    //       }
    //       catch(Error $e){
    //         $response["message"] = "Unknown error occurs in BillPayment";
    //       }
    //     }
    //   }


    //   if($bill_type == 'electricCharge'){
    //     if($this->acctInfo['accBalance'] >= $this->acctInfo['accElectricCharge']) {
    //       $updatedBalance = $this->acctInfo['accBalance'] - $this->acctInfo['accElectricCharge'];

    //       try{
    //         DBConnection::saveTransaction($this->acctInfo['accNo'], $updatedBalance);
    //         DBConnection::saveTransactionElectricCharge($this->acctInfo['accNo'], 0);

    //         $response = ServiceAuthentication::accountAuthenticationProvider($this->acctInfo['accNo']);
    //         $response["isError"] = false;
    //         $response["message"] = "";
    //       }
    //       catch(Error $e){
    //         $response["message"] = "Unknown error occurs in BillPayment";
    //       }
    //     }
    //   }


    //   if($bill_type == 'phoneCharge'){
    //     if($this->acctInfo['accBalance'] >= $this->acctInfo['accPhoneCharge']) {
    //       $updatedBalance = $this->acctInfo['accBalance'] - $this->acctInfo['accPhoneCharge'];

    //       try{
    //         DBConnection::saveTransaction($this->acctInfo['accNo'], $updatedBalance);
    //         DBConnection::saveTransactionPhoneCharge($this->acctInfo['accNo'], 0);

    //         $response = ServiceAuthentication::accountAuthenticationProvider($this->acctInfo['accNo']);
    //         $response["isError"] = false;
    //         $response["message"] = "";
    //       }
    //       catch(Error $e){
    //         $response["message"] = "Unknown error occurs in BillPayment";
    //       }
    //     }
    //   }

      return $response;
    // }
    }
}


