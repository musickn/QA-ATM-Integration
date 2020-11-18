<?php namespace Stub;

class StubDeposit
{
    private $accNo;

    public function __construct(string $accNo)
    {
        $this->accNo = $accNo;
    }

    public function doDeposit(string $amount): array
    {
        if ($this->accNo == '1234567890') {
            return array("accNo" => $this->accNo, "accName" => "TestAccountName", "accBalance" => $amount + 20);
        } else {
            return array("isError" => true, "message" => "Account number : " . $this->accNo . " not found.");
        }
    }
}
