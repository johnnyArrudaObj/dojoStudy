<?php

declare(strict_types=1);

namespace Architecture\Infrastructure\Repository;

use Architecture\Domain\ValueObjects\Cpf;
use Architecture\Domain\Person\Person;
use Architecture\Domain\Person\PersonNotFound;
use Architecture\Domain\Person\PersonRepository;
use PDO;

class RepositoryPDO implements PersonRepository
{

    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function addPerson(Person $person): void
    {
        $stmt = $this->connection->prepare(
            'INSERT INTO persons (cpf, name, email) VALUES (:cpf, :name, :email);'
        );

        $stmt->bindValue(':cpf', $person->getCpf());
        $stmt->bindValue(':name', $person->getName());
        $stmt->bindValue(':email', $person->getEmail());

        $stmt->execute();
    }

    public function searchByCpf(Cpf $cpf): Person
    {
        $stmt = $this->connection->prepare(
            'SELECT cpf, name, email FROM persons WHERE persons.cpf = ?;'
        );

        $stmt->bindValue(1, $cpf);
        $stmt->execute();

        $personData = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if (count($personData) == 0) {
            throw new PersonNotFound($cpf);
        }

        return $this->mapPerson($personData);
    }

    private function mapPerson(array $personData): Person
    {
        $firstPerson = $personData[0];
        return Person::buildPerson($firstPerson['cpf'], $firstPerson['name'], $firstPerson['email']);
    }

    public function searchAll(): array
    {
        $stmt = $this->connection->query(
            'SELECT cpf, name, email FROM persons;'
        );

        $listOfPersons = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $persons = [];

        foreach ($listOfPersons as $dataPerson) {
            if (!array_key_exists($dataPerson['cpf'], $persons)) {
                $persons[$dataPerson['cpf']] = Person::buildPerson(
                    $dataPerson['cpf'],
                    $dataPerson['name'],
                    $dataPerson['email']
                );
            }
        }

        return array_values($persons);
    }
}
