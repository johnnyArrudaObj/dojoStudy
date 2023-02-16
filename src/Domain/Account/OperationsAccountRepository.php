<?php

namespace Architecture\Domain\Account;

use Architecture\Domain\ValueObjects\Cpf;

interface OperationsAccountRepository
{
    public function add(BankAccount $bankAccount): BankAccount;

    public function update(BankAccount $bankAccount): BankAccount;

    public function get(Cpf $cpf): BankAccount;
}