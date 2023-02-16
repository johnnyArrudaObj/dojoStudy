<?php

declare(strict_types=1);

namespace Architecture\Domain\Account\Command;


use Architecture\Domain\Account\Transfer\TransferBankAccountDto;
use Architecture\Domain\Account\Transfer\TransferToAccountSevice;

class TransferToAccountCommand
{
    public function __construct(private readonly TransferToAccountSevice $transferToAccountSevice) {}

    public function execute(TransferBankAccountDto $data): string
    {
        return $this->transferToAccountSevice->transfer($data);
    }
}
