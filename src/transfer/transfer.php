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
        $response = array("isError" => true);
        if (!preg_match('/^[0-9]*$/',$this->srcNumber) || !preg_match('/^[0-9]*$/',$targetNumber)) {
            $response["message"] = "หมายเลขบัญชีต้องเป็นตัวเลขเท่านั้น";
        }
        elseif (strlen($this->srcNumber) != 10 || strlen($targetNumber) != 10) {
            $response["message"] = "หมายเลขบัญชีต้องมีจำนวน 10 หลัก";
        } elseif ((int)$amount <=0) {
            $response["message"] = "ยอดการโอนต้องมากกว่า 0 บาท";
        } elseif ((int)$amount > 9999999) {
            $response["message"] = "ยอดการโอนต้องไม่มากกว่า 9,999,999 บาท";
        } elseif ($this->srcNumber == $targetNumber) {
            $response["message"] = "ไม่สามารถโอนไปบัญชีตัวเองได้";
        } else {
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


