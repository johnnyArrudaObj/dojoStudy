<?php

declare(strict_types=1);

namespace Architecture\Infrastructure\Repository\Person;

use Architecture\Domain\Person\PersonNotFound;
use Architecture\Domain\ValueObjects\Cpf;
use Architecture\Domain\Person\Person;
use Architecture\Domain\Person\PersonRepository;
use Exception;

/**
 *
 */
class PersonRepositoryMemory implements PersonRepository
{
    /**
     * @var array<Person>
     */
    private array $persons = [];

    /**
     * @param Person $person
     * @return void
     */
    public function add(Person $person): void
    {
        $this->persons[(string)$person->getCpf()] = $person;
    }

    /**
     * @throws Exception
     */
    public function searchByCpf(Cpf $cpf): Person
    {
        if (isset($this->persons[(string)$cpf])) {
            return $this->persons[(string)$cpf];
        }

        throw new PersonNotFound($cpf);
    }

    /**
     * @param Cpf $cpf
     * @param Person $person
     * @return void
     */
    public function updateByCpf(Cpf $cpf, Person $person): void
    {
        if (isset($this->persons[(string)$cpf])) {
            $this->persons[(string)$cpf] = $person;
        }
    }

    /**
     * @return array|Person[]
     */
    public function getAll(): array
    {
        return $this->persons;
    }

    public function deleteByCpf(Cpf $cpf): void
    {
        // TODO: Implement deleteByCpf() method.
    }
}
