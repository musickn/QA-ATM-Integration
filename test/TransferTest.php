<?php

use PHPUnit\Framework\TestCase;
use Operation\transfer;

require_once __DIR__.'./../src/transfer/transfer.php';


final class TransferTest extends TestCase {

    function testTransferSuccess() {

        $srcAccNo =  '1234567890';
        $srcAccName = 'Walter Greenhalgh';
        $tran = new transfer($srcAccNo,$srcAccName);
        $srcAccBalance = 10000;

        $targetNumber = '9876543210';
        $targetAmount = 2000;

        $result = $tran->doTransfer($targetNumber,$targetAmount);

        $this->assertEquals(($srcAccBalance - $targetAmount), $result['accBalance']);
        $this->assertFalse($result['isError']);
        $this->assertEquals("",$result['message']);
    }

    // function testTransferFail() {

    //     $srcAccNo =  '1234567890';
    //     $srcAccName = 'Walter Greenhalgh';
    //     $tran = new transfer($srcAccNo,$srcAccName);
    //     $srcAccBalance = '10000';

    //     $targetNumber = '9876543210';
    //     $targetAmount = '2000';

    //     $result = $tran->doTransfer($targetNumber,$targetAmount);

    //     $this->assertFalse(!$result['isError']);
    //     $this->assertEquals("ดำเนินการไม่สำเร็จ",$result['message']);
    // }

    // //TC-TF-001
    // function testTransferInvalidAccount() {

    //     // $srcAccNo =  '1234567890';
    //     // $srcAccName = 'Walter Greenhalgh';
    //     // $tran = new transfer($srcAccNo,$srcAccName);
    //     // $srcAccBalance = '500000';

    //     // $targetNumber = '4545554545';
    //     // $targetAmount = '20000';

    //     // $result = $tran->doTransfer($targetNumber,$targetAmount);

    //     // $this->assertFalse(!$result['isError']);
    //     // $this->assertEquals("ดำเนินการไม่สำเร็จ",$result['message']);

    //     $srcAccNo =  '1234567890';
    //     $srcAccName = 'Walter Greenhalgh';
    //     $tran = new transfer($srcAccNo,$srcAccName);
    //     $srcAccBalance = 500000;

    //     $targetNumber = 'degcbtynft';
    //     $targetAmount = 20000;

    //     $result = $tran->doTransfer($targetNumber,$targetAmount);

    //     $this->assertFalse(!$result['isError']);
    //     $this->assertEquals("หมายเลขบัญชีต้องเป็นตัวเลขเท่านั้น",$result['message']);
    // }

    // //TC-TF-002
    // function testTransferInvalidTarget() {

    //     $srcAccNo =  '1234567890';
    //     $srcAccName = 'Walter Greenhalgh';
    //     $tran = new transfer($srcAccNo,$srcAccName);
    //     $srcAccBalance = 500000;

    //     $targetNumber = 'degcbtynft';
    //     $targetAmount = 20000;

    //     $result = $tran->doTransfer($targetNumber,$targetAmount);

    //     $this->assertFalse(!$result['isError']);
    //     $this->assertEquals("หมายเลขบัญชีต้องเป็นตัวเลขเท่านั้น",$result['message']);
    // }

    // //TC-TF-003
    // function testTransferOnlyNumber() {

    //     $srcAccNo =  '3455677565';
    //     $srcAccName = 'Omar Reilly';
    //     $tran = new transfer($srcAccNo,$srcAccName);
    //     $srcAccBalance = 500000;

    //     $targetNumber = '1234567890';
    //     $targetAmount = 'one-hundred';

    //     $result = $tran->doTransfer($targetNumber,$targetAmount);

    //     $this->assertFalse(!$result['isError']);
    //     $this->assertEquals("จำนวนเงินต้องเป็นตัวเลขเท่านั้น",$result['message']);
    // }


}
