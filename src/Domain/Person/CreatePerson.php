<?php

declare(strict_types=1);

namespace Architecture\Domain\Person;

class CreatePerson
{
    public function __construct(private readonly PersonRepository $personRepository)
    {
    }

    public function create(CreatePersonDto $data): void
    {
        $person = Person::buildPerson($data->cpf, $data->name, $data->email);
        $this->personRepository->add($person);
    }
}
