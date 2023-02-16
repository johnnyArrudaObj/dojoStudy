<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

use Architecture\Domain\Person\CreatePersonCommand;
use Architecture\Domain\Person\PersonDto;
use Architecture\Domain\ValueObjects\Cpf;
use Architecture\Infrastructure\Repository\PersonRepositoryPDO;

try {
    $data = json_decode(file_get_contents("php://input"), true, 512, JSON_THROW_ON_ERROR);
} catch (JsonException $e) {
    var_dump($e->getMessage());
}

$personData = new PersonDto($data['cpf'], $data['name'], $data['email']);

$container = require '../config/container.php';

$factoryPerson = $container->get(CreatePersonCommand::class);
$repositoryPDO = $container->get(PersonRepositoryPDO::class);

if (!$personAdded = $repositoryPDO->searchByCpf(new Cpf($data['cpf']))) {
    $personAdded = $factoryPerson->create($personData);
};

try {
    echo json_encode($personAdded, JSON_THROW_ON_ERROR);
} catch (JsonException $e) {
    var_dump($e->getMessage());
}
