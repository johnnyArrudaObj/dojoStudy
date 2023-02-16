<?php

declare(strict_types=1);


namespace Architecture\Domain\Account\Transfer;

class TransferBankAccountDto
{
    public function __construct(
        public string $cpfOrigin,
        public string $cpfDestiny,
        public int $amount
    ) {}
}