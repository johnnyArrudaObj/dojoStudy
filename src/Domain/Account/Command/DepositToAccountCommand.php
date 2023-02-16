<?php

declare(strict_types=1);

namespace Architecture\Domain\Account\Command;

use Architecture\Domain\Account\Deposit\DepositBankAccountDto;
use Architecture\Domain\Account\Deposit\DepositToAccountSevice;

class DepositToAccountCommand
{
    public function __construct(private readonly DepositToAccountSevice $depositToAccountSevice) {}

    public function execute(DepositBankAccountDto $data): string
    {
        return $this->depositToAccountSevice->deposit($data);
    }
}
