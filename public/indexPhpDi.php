<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

use Architecture\Domain\Person\CreatePerson;
use Architecture\Domain\Person\CreatePersonDto;
use Architecture\Domain\ValueObjects\Cpf;
use Architecture\Infrastructure\Repository\PersonRepositoryPDO;

$data = json_decode(file_get_contents("php://input"), true);

$personData = new CreatePersonDto($data['cpf'], $data['name'], $data['email']);

$container = require_once '../config/container.php';

$factoryPerson = $container->get(CreatePerson::class);
$repositoryPDO = $container->get(PersonRepositoryPDO::class);

$personAdded = $repositoryPDO->searchByCpf(new Cpf($data['cpf']));

$factoryPerson->create($personData);

echo json_encode($personAdded);
