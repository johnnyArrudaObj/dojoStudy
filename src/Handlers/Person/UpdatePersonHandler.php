<?php

declare(strict_types=1);

namespace Architecture\Handlers\Person;

use Architecture\Domain\Person\Command\UpdatePersonCommand;
use Architecture\Domain\Person\PersonDto;
use Architecture\Domain\ValueObjects\Cpf;
use Architecture\Handlers\HandlerInterface;
use InvalidArgumentException;

class UpdatePersonHandler implements HandlerInterface
{
    private UpdatePersonCommand $updatePerson;

    public function __construct(UpdatePersonCommand $updatePerson)
    {
        $this->updatePerson = $updatePerson;
    }

    public function execute(array $options): void
    {
        if (!isset($options[2], $options[3], $options[4], $options[5])) {
            throw new InvalidArgumentException('Missing parameter');
        }

        $personData = new PersonDto($options[3], $options[4], $options[5]);
        $this->updatePerson->execute(new Cpf($options[2]), $personData);
    }
}