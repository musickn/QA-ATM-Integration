<?php namespace Operation;

require_once __DIR__."./../../src/deposit/DepositService.php";
require_once __DIR__."./../serviceauthentication/serviceauthentication.php";
require_once __DIR__."./../serviceauthentication/AccountInformationException.php";
require_once __DIR__."./../serviceauthentication/DBConnection.php";
use DBConnection;
use ServiceAuthentication;
use DepositService;
use AccountInformationException;

class transfer{
    private $srcNumber,$srcName, $targetNumber, $amount;

    public function __construct(string $srcNumber,string $srcName){
        $this->srcNumber = $srcNumber;
        $this->srcName = $srcName;
    }

    public function doTransfer(string $targetNumber, string $amount){
        $this->targetNumber = $targetNumber;
        $this->amount = $amount;
        $response = array("isError" => true);
        if (!preg_match('/^[0-9]*$/',$this->srcNumber)) {
            $response["message"] = "ระบบไม่สามารถให้กรอกเลขบัญชีเกิน 10 หลักได้";
        }
        elseif (strlen($this->srcNumber) != 10) {
            $response["message"] = "หมายเลขบัญชีต้องมีจำนวน 10 หลัก";
        } else {
            // try {
            //     $result = $this->deposit($this->amount);
            // }
            try
            {
                $account =  $this->accountAuthenticationProvider($this->targetNumber);
                $accNo = $account['accNo'];
                $updatedBalance = $account['accBalance'] + (int)$amount;
                // if($this->saveTransaction($accNo, $updatedBalance))
                // {
                //     $response = array(
                //         "isError" => false,
                //         "accNo" => $accNo,
                //         "accBalance" => $updatedBalance,
                //         "accName" => $account['accName'],
                //     );
                    
                // }
                // else
                // {
                //     $response["message"] = "Invalid.";
                // }
            }
            catch(AccountInformationException $e)
            {
                $result["message"] = $e->getMessage();
            }            
        }
        return $response;
    }
    public function deposit(string $amount):array
    {
        return  DepositService::deposit($amount);
    }

    public function withdraw(string $amount):array
    {
        //call WithdrawService
    }

}


