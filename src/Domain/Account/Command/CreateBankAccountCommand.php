<?php

declare(strict_types=1);

namespace Architecture\Domain\Account\Command;

use Architecture\Domain\Account\BankAccount;
use Architecture\Domain\Account\BankAccountDto;
use Architecture\Domain\Account\OperationsAccountRepository;

class CreateBankAccountCommand
{
    public function __construct(private readonly OperationsAccountRepository $bankAccountRepository) {}

    public function execute(BankAccountDto $bankAccountDto): void
    {
        $account = BankAccount::buildBankAccount($bankAccountDto->cpf, 0);
        $this->bankAccountRepository->add($account);
    }
}
