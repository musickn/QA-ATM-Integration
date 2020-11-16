<?php

use PHPUnit\Framework\TestCase;
use Operation\transfer;

require_once __DIR__.'./../src/transfer/transfer.php';

final class TransferTest extends TestCase {
    function testTransferSuccess() {
        $tran = new transfer();

        $srcAccNo =  '1234567890';
        $srcAccName = 'Methawi';
        $srcAccBalance = 200000;

        $targetNumber = '2222222222';
        $targetAmount = 2000;

        $result = $tran.doTransfer($targetNumber,$targetAmount);

        $this->assertEquals($srcAccBalance - $targetAmount, $result['accBalance']);
        $this->assertFalse($result['isError']);
        $this->assertEquals("",$result['message']);
    }
}
