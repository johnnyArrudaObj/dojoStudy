<?php

declare(strict_types=1);

namespace Architecture\Domain\Person;

use Architecture\Domain\ValueObjects\Cpf;
use DomainException;
use JetBrains\PhpStorm\Pure;

class PersonNotFound extends DomainException
{
    public function __construct(Cpf $cpf)
    {
        parent::__construct("Person with this $cpf not found");
    }
}
