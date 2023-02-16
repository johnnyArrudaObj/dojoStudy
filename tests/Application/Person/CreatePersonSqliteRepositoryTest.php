<?php

declare(strict_types=1);

namespace Application\Person;

use Architecture\Domain\Person\CreatePersonCommand;
use Architecture\Domain\Person\PersonDto;
use Architecture\Domain\ValueObjects\Cpf;
use Architecture\Infrastructure\Repository\PersonRepositoryPDO;
use Exception;
use PDO;
use PHPUnit\Framework\TestCase;

class CreatePersonSqliteRepositoryTest extends TestCase
{

    /** @var PDO */
    private static \PDO $pdo;

    public static function setUpBeforeClass(): void
    {
        self::$pdo = new \PDO('sqlite::memory:');
        self::$pdo->exec('create table persons (
                name  varchar(100),
                email varchar(50),
                cpf   varchar(15)
            );'
        );
    }

    protected function setUp(): void
    {
        self::$pdo->beginTransaction();
    }

    /**
     * @throws Exception
     */
    public function test_ShouldCreatePerson_WithSqliteRepository(): void
    {
        $personData = new PersonDto($cpf = '306.673.290-80', $name = 'Johnny PDO', $email = 'johnPDO@email.com.br');

        $repositoryMemory = new PersonRepositoryPDO(self::$pdo);
        $factoryPerson = new CreatePersonCommand($repositoryMemory);

        $factoryPerson->create($personData);
        $person = $repositoryMemory->searchByCpf(new Cpf($cpf));

        $this->assertEquals($person->getName(), $name);
        $this->assertEquals($person->getEmail(), $email);
        $this->assertEquals($person->getCpf(), $cpf);
    }

    protected function tearDown(): void
    {
        self::$pdo->rollBack();
    }
}
