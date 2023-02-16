<?php

declare(strict_types=1);

namespace Architecture\Domain\Account\Deposit;

class DepositBankAccountDto
{
    public function __construct(
        public string $cpf,
        public int $amount
    ) {}
}