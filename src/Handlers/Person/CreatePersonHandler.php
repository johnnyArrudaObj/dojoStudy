<?php

declare(strict_types=1);

namespace Architecture\Handlers\Person;

use Architecture\Domain\Person\Command\CreatePersonCommand;
use Architecture\Domain\Person\PersonDto;
use Architecture\Handlers\HandlerInterface;
use InvalidArgumentException;

class CreatePersonHandler implements HandlerInterface
{
    private CreatePersonCommand $createPerson;

    public function __construct(CreatePersonCommand $createPerson)
    {
        $this->createPerson = $createPerson;
    }

    public function execute(array $options): void
    {
        if (!isset($options[2], $options[3], $options[4])) {
            throw new InvalidArgumentException('Missing parameter');
        }

        $personData = new PersonDto($options[2], $options[3], $options[4]);
        $this->createPerson->execute($personData);
    }
}