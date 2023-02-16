<?php

declare(strict_types=1);

namespace Architecture\Domain\Person\Command;

use Architecture\Domain\Person\Person;
use Architecture\Domain\Person\PersonDto;
use Architecture\Domain\Person\PersonRepository;

class CreatePersonCommand
{
    public function __construct(private readonly PersonRepository $personRepository) {}

    public function execute(PersonDto $data): void
    {
        $person = Person::buildPerson($data->cpf, $data->name, $data->email);
        $this->personRepository->add($person);
    }
}
