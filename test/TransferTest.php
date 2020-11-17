<?php

use PHPUnit\Framework\TestCase;
use Operation\transfer;

require_once __DIR__.'./../src/transfer/transfer.php';

final class TransferTest extends TestCase {

    function testTransferSuccess() {

        $tran = new transfer();
        $srcAccNo =  '1234567890';
        $srcAccName = 'Walter Greenhalgh';
        $srcAccBalance = 10000;

        $targetNumber = '9876543210';
        $targetAmount = 2000;

        $result = $tran.doTransfer($targetNumber,$targetAmount);

        $this->assertEquals($srcAccBalance - $targetAmount, $result['accBalance']);
        $this->assertFalse($result['isError']);
        $this->assertEquals("",$result['message']);
    }

    //TC-TF-001
    function testTransferInvalidAccount() {

        $tran = new transfer();
        $srcAccNo =  '1234567890';
        $srcAccName = 'Walter Greenhalgh';
        $srcAccBalance = 500000;

        $targetNumber = '4545554545';
        $targetAmount = 20000;

        $result = $tran.doTransfer($targetNumber,$targetAmount);

        $this->assertFalse(!$result['isError']);
        $this->assertEquals("Account number or PIN is Invalid",$result['message']);
    }

    //TC-TF-002
    function testTransferInvalidTarget() {

        $tran = new transfer();
        $srcAccNo =  '1234567890';
        $srcAccName = 'Walter Greenhalgh';
        $srcAccBalance = 500000;

        $targetNumber = 'degcbtynft';
        $targetAmount = 20000;

        $result = $tran.doTransfer($targetNumber,$targetAmount);

        $this->assertFalse(!$result['isError']);
        $this->assertEquals("Target Account sould be number only",$result['message']);
    }

    //TC-TF-003
    function testTransferOnlyNumber() {

        $tran = new transfer();
        $srcAccNo =  '3455677565';
        $srcAccName = 'Omar Reilly';
        $srcAccBalance = 500000;

        $targetNumber = '1234567890';
        $targetAmount = 'one-hundred';

        $result = $tran.doTransfer($targetNumber,$targetAmount);

        $this->assertFalse(!$result['isError']);
        $this->assertEquals("Target Account sound be number only",$result['message']);
    }


}
