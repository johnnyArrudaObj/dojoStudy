<?php

declare(strict_types=1);

namespace Architecture\Infrastructure\Repository;

use Architecture\Domain\ValueObjects\Cpf;
use Architecture\Domain\Person\Person;
use Architecture\Domain\Person\PersonNotFound;
use Architecture\Domain\Person\PersonRepository;
use Exception;
use RuntimeException;

class RepositoryMemory implements PersonRepository
{

    private array $persons = [];

    public function addPerson(Person $person): void
    {
        $this->persons[] = $person;
    }

    /**
     * @throws Exception
     */
    public function searchByCpf(Cpf $cpf): Person
    {
        $personFiltered = array_filter(
            $this->persons,
            static fn (Person $person) => $person->getCpf() == $cpf
        );

//        $personFiltered = array_filter($this->persons,function(Person $person) use ($cpf){
//            return $person->getCpf() == $cpf;
//        });

        if (count($personFiltered) === 0) {
            throw new PersonNotFound($cpf);
        }

        if (count($personFiltered) > 1) {
            throw new RuntimeException();
        }

        return $personFiltered[0];
    }

    public function searchAll(): array
    {
        return $this->persons;
    }
}
