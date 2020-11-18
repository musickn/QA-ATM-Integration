<?php namespace Operation;

require_once __DIR__."./../../src/deposit/DepositService.php";
require_once __DIR__."./../../src/withdraw/StubWithdrawal.php";
require_once __DIR__."./../../src/withdraw/StubDeposit.php";
require_once __DIR__."./../serviceauthentication/serviceauthentication.php";
require_once __DIR__."./../serviceauthentication/AccountInformationException.php";
require_once __DIR__."./../serviceauthentication/DBConnection.php";
use DBConnection;
use ServiceAuthentication;
use Operation\DepositService;
use AccountInformationException;
use Stub\StubWithdrawal;
use Stub\StubDeposit;

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
        } elseif (strlen($this->srcNumber) != 10 || strlen($targetNumber) != 10) {
            $response["message"] = "หมายเลขบัญชีต้องมีจำนวน 10 หลัก";
        } elseif ((int)$amount <=0) {
            $response["message"] = "ยอดการโอนต้องมากกว่า 0 บาท";
        } elseif ((int)$amount > 9999999) {
            $response["message"] = "ยอดการโอนต้องไม่มากกว่า 9,999,999 บาท";
        } elseif ($this->srcNumber == $targetNumber) {
            $response["message"] = "ไม่สามารถโอนไปบัญชีตัวเองได้";
        } else if (!is_int($this->$amount) || is_double($this->$amount)) {
            $response["message"] = "จำนวนเงินต้องเป็นตัวเลขเท่านั้น";
        } else {
            try
            {
                $srcAccount = $this->accountAuthenticationProvider($this->srcNumber);
                $desAccount = $this->accountAuthenticationProvider($targetNumber);
                if ($srcAccount['accBalance'] - (int)$amount < 0) {
                    $response["message"] = "คุณมียอดเงินในบัญชีไม่เพียงพอ";
                } else {
                    $withdraw = new StubWithdrawal($srcAccount['accNo']);
                    $withdrawResult = $withdraw->withdraw($amount);

                    $deposit =  new StubDeposit($desAccount['accNo']);
                    $depositResult = $deposit->deposit($amount);
                    if ($depositResult['isError'] || $withdrawResult['isError']) {
                        $response['message'] = "ดำเนินการไม่สำเร็จ";
                        // This would have an issues if one can complete but another doesn't.
                    } else {
                        $response['isError'] = false;
                        $response['accBalance'] = $withdrawResult['accBalance'];
                    }
                }     
            } catch(AccountInformationException $e)
            {
                $response["message"] = $e->getMessage();
            }    
        }
        return $response;
    }
    public function accountAuthenticationProvider(string $acctNum) : array
    {
        return  ServiceAuthentication::accountAuthenticationProvider($acctNum);
    }
    public function deposit(string $amount):array
    {
        return  StubDeposit::deposit($amount);
    }

    public function withdraw(string $amount):array
    {
        //call WithdrawService
        return  StubWithdrawal::withdraw($amount);
    }

}


