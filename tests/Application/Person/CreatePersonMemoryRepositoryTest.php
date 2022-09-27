<?php

declare(strict_types=1);

namespace Application\Person;

use Architecture\Domain\Person\CreatePerson;
use Architecture\Domain\Person\CreatePersonDto;
use Architecture\Domain\ValueObjects\Cpf;
use Architecture\Domain\Person\PersonNotFound;
use Architecture\Infrastructure\Repository\RepositoryMemory;
use Exception;
use PHPUnit\Framework\TestCase;

class CreatePersonMemoryRepositoryTest extends TestCase
{

    /**
     * @throws Exception
     */
    public function test_ShouldCreatePerson_WithMemoryRepository(): void
    {
        $personData = new CreatePersonDto($cpf = '583.455.390-76', $name = 'Johnny Memory', $email = 'johnMemory@email.com.br');

        $repositoryMemory = new RepositoryMemory();
        $factoryPerson = new CreatePerson($repositoryMemory);

        $factoryPerson->create($personData);
        $person = $repositoryMemory->searchByCpf(new Cpf($cpf));

        $this->assertEquals($person->getName(), $name);
        $this->assertEquals($person->getEmail(), $email);
        $this->assertEquals($person->getCpf(), $cpf);
    }

    /**
     * @throws Exception
     */
    public function test_ShouldThrowException_IfDontFoundPerson(): void
    {
        $cpf = '640.771.850-33';
        $this->expectException(PersonNotFound::class);
        $this->expectExceptionMessage("Person with this $cpf not found");

        $repositoryMemory = new RepositoryMemory();
        $repositoryMemory->searchByCpf(new Cpf($cpf));
    }
}
