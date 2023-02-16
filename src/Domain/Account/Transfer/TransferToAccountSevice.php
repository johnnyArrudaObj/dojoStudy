<?php

declare(strict_types=1);


namespace Architecture\Domain\Account\Transfer;

use Architecture\Domain\Account\BankAccount;
use Architecture\Domain\Account\OperationsAccountRepository;
use Architecture\Domain\ValueObjects\Cpf;

class TransferToAccountSevice
{

    public function __construct(private readonly OperationsAccountRepository $operationsAccountRepository) {}

    public function transfer(TransferBankAccountDto $transferBankAccountDto): string
    {
        $originAccount = $this->operationsAccountRepository->get(new Cpf($transferBankAccountDto->cpfOrigin));
        $destinyAccount = $this->operationsAccountRepository->get(new Cpf($transferBankAccountDto->cpfDestiny));

        $this->add($destinyAccount, $transferBankAccountDto);
        $this->withdraw($originAccount, $transferBankAccountDto);

        $this->operationsAccountRepository->update($originAccount);
        $this->operationsAccountRepository->update($destinyAccount);

        return "Transfer Ok.";
    }

    public function add(BankAccount $destinyAccount, TransferBankAccountDto $transferBankAccountDto): void
    {
        $total = $destinyAccount->getBalance() + $transferBankAccountDto->amount;
        $destinyAccount->setBalance($total);
    }

    public function withdraw(BankAccount $originAccount, TransferBankAccountDto $transferBankAccountDto): void
    {
        $total = $originAccount->getBalance() - $transferBankAccountDto->amount;
        $originAccount->setBalance($total);
    }
}