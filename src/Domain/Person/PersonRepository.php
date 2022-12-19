<?php

declare(strict_types=1);

namespace Architecture\Domain\Person;

use Architecture\Domain\ValueObjects\Cpf;

interface PersonRepository
{
    public function add(Person $person): void;
    public function searchByCpf(Cpf $cpf): Person;
    public function updateByCpf(Cpf $cpf, Person $person): void;
    /** @return Person[] */
    public function getAll(): array;
}
