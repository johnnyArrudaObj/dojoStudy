<?php

declare(strict_types=1);

namespace Architecture\Infrastructure\Repository;

use Architecture\Domain\Person\Person;
use Architecture\Domain\Person\PersonNotFound;
use Architecture\Domain\ValueObjects\Cpf;

class PersonMapping
{
    /**
     * @param array<array<string>> $listOfPersons
     * @return array<Person>
     */
    public function mapPersons(array $listOfPersons): array
    {
        $persons = [];

        foreach ($listOfPersons as $dataPerson) {
            if (!array_key_exists($dataPerson['cpf'], $persons)) {
                $persons[$dataPerson['cpf']] = $this->buildPerson($dataPerson);
            }
        }

        return array_values($persons);
    }

    /**
     * @param array<array<string>> $listOfPerson
     * @param Cpf $cpf
     * @return Person
     */
    public function mapPerson(array $listOfPerson, Cpf $cpf): Person
    {
        if (count($listOfPerson) == 0) {
            throw new PersonNotFound($cpf);
        }

        $firstPerson = $listOfPerson[0];

        return $this->buildPerson($firstPerson);
    }

    /**
     * @param array<string> $dataPerson
     * @return Person
     */
    private function buildPerson(array $dataPerson): Person
    {
        return Person::buildPerson(
            $dataPerson['cpf'],
            $dataPerson['name'],
            $dataPerson['email']
        );
    }
}
