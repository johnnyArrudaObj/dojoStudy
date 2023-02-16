<?php

declare(strict_types=1);

namespace Architecture\Domain\Account;

use Architecture\Domain\ValueObjects\Cpf;
use DomainException;

class BankAccountNotFound extends DomainException
{
    public function __construct(Cpf $cpf)
    {
        parent::__construct("Bank account with this $cpf not found");
    }
}
