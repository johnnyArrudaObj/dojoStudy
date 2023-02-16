<?php

declare(strict_types=1);

namespace Architecture\Domain\Person\Command;

use Architecture\Domain\Person\PersonRepository;
use Architecture\Domain\ValueObjects\Cpf;

class DeletePersonCommand
{
    public function __construct(private readonly PersonRepository $personRepository) {}

    public function execute(Cpf $cpfToDelete): void
    {
        $this->personRepository->deleteByCpf($cpfToDelete);
    }
}
