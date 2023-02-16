<?php

declare(strict_types=1);

namespace Architecture\Domain\Person\Command;

use Architecture\Domain\Person\Person;
use Architecture\Domain\Person\PersonDto;
use Architecture\Domain\Person\PersonRepository;
use Architecture\Domain\ValueObjects\Cpf;

class UpdatePersonCommand
{
    public function __construct(private readonly PersonRepository $personRepository) {}

    public function execute(Cpf $cpfSearched, PersonDto $data): void
    {
        $person = Person::buildPerson($data->cpf, $data->name, $data->email);
        $this->personRepository->updateByCpf($cpfSearched, $person);
    }
}
