<?php

declare(strict_types=1);

namespace Architecture\Infrastructure\Repository;

use Architecture\Domain\ValueObjects\Cpf;
use Architecture\Domain\Person\Person;
use Architecture\Domain\Person\PersonRepository;
use PDO;

class PersonRepositoryPDO implements PersonRepository
{
    private PersonMapping $servicePerson;

    public function __construct(private readonly PDO $connection)
    {
        $this->servicePerson = new PersonMapping();
    }

    public function add(Person $person): void
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

        return $this->servicePerson->mapPerson(
            $stmt->fetchAll(\PDO::FETCH_ASSOC),
            $cpf
        );
    }

    public function updateByCpf(Cpf $cpf, Person $person): void
    {
        $stmt = $this->connection->prepare(
            'UPDATE persons SET cpf = ?, name = ?, email = ? WHERE persons.cpf = ?;'
        );

        $stmt->bindValue(1, $person->getCpf());
        $stmt->bindValue(2, $person->getName());
        $stmt->bindValue(3, $person->getEmail());
        $stmt->bindValue(4, $cpf);

        $stmt->execute();
    }

    public function getAll(): array
    {
        $stmt = $this->connection->prepare(
            'SELECT cpf, name, email FROM persons;'
        );
        $stmt->execute();

        return $this->servicePerson->mapPersons(
            $stmt->fetchAll(\PDO::FETCH_ASSOC)
        );
    }
}
