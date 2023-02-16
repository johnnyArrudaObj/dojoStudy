<?php

declare(strict_types=1);

namespace Architecture\Domain\Account;

class BankAccountDto
{
    public function __construct(
        public string $cpf
    ) {}
}
