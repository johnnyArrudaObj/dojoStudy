<?php

declare(strict_types=1);

namespace Architecture\Domain\Person;

use Architecture\Domain\ValueObjects\Cpf;

interface PersonRepository
{
    public function addPerson(Person $person): void;
    public function searchByCpf(Cpf $cpf): Person;
    /** @return Person[] */
    public function searchAll(): array;
}
