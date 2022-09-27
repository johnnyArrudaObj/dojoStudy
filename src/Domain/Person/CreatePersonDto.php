<?php

declare(strict_types=1);

namespace Architecture\Domain\Person;

class CreatePersonDto
{
    public function __construct(
        public string $cpf,
        public string $name,
        public string $email
    ) {}
}
