<?php

declare(strict_types=1);


namespace Architecture\Domain\Account\Deposit;

use Architecture\Domain\Account\BankAccount;
use Architecture\Domain\Account\OperationsAccountRepository;
use Architecture\Domain\ValueObjects\Cpf;

class DepositToAccountSevice
{

    public function __construct(private readonly OperationsAccountRepository $operationsAccountRepository) {}

    public function deposit(DepositBankAccountDto $depositBankAccountDto): string
    {
        $originAccount = $this->operationsAccountRepository->get(new Cpf($depositBankAccountDto->cpf));

        $this->add($originAccount, $depositBankAccountDto);

        $this->operationsAccountRepository->update($originAccount);

        return "Deposit Ok.";
    }

    public function add(BankAccount $originAccount, DepositBankAccountDto $depositBankAccountDto): void
    {
        $total = $originAccount->getBalance() + $depositBankAccountDto->amount;
        $originAccount->setBalance($total);
    }
}