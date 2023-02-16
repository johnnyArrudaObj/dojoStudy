<?php

declare(strict_types=1);

namespace Architecture\Handlers\Person;

use Architecture\Domain\Person\DeletePersonCommand;
use Architecture\Domain\ValueObjects\Cpf;
use Architecture\Handlers\HandlerInterface;
use InvalidArgumentException;

class DeletePersonHandler implements HandlerInterface
{
    private DeletePersonCommand $deletePerson;

    public function __construct(DeletePersonCommand $deletePerson)
    {
        $this->deletePerson = $deletePerson;
    }

    public function execute(array $options): void
    {
        if (!isset($options[2])) {
            throw new InvalidArgumentException('Missing parameter');
        }

        $this->deletePerson->execute(new Cpf($options[2]));
    }
}