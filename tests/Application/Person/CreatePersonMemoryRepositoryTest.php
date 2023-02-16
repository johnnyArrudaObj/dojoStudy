<?php

declare(strict_types=1);

namespace Application\Person;

use Architecture\Domain\Person\CreatePersonCommand;
use Architecture\Domain\Person\PersonDto;
use Architecture\Domain\ValueObjects\Cpf;
use Architecture\Domain\Person\PersonNotFound;
use Architecture\Infrastructure\Repository\PersonRepositoryMemory;
use Exception;
use PHPUnit\Framework\TestCase;

class CreatePersonMemoryRepositoryTest extends TestCase
{

    /**
     * @throws Exception
     */
    public function test_ShouldCreatePerson_WithMemoryRepository(): void
    {
        $personData = new PersonDto($cpf = '583.455.390-76', $name = 'Johnny Memory', $email = 'johnMemory@email.com.br');

        $repositoryMemory = new PersonRepositoryMemory();
        $factoryPerson = new CreatePersonCommand($repositoryMemory);

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

        $repositoryMemory = new PersonRepositoryMemory();
        $repositoryMemory->searchByCpf(new Cpf($cpf));
    }
}
