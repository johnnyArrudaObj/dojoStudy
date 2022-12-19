<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

use Architecture\Domain\Person\CreatePerson;
use Architecture\Domain\Person\CreatePersonDto;
use Architecture\Domain\ValueObjects\Cpf;
use Architecture\Infrastructure\Persistence\ConnectionCreator;
use Architecture\Infrastructure\Repository\PersonRepositoryPDO;

$data = json_decode(file_get_contents("php://input"), true);

$pdo = ConnectionCreator::createConnection();

//SAVE PERSON
$personData = new CreatePersonDto($data['cpf'], $data['name'], $data['email']);

$repositoryPDO = new PersonRepositoryPDO($pdo);
$factoryPerson = new CreatePerson($repositoryPDO);

try {
    $pdo->beginTransaction();
    $factoryPerson->create($personData);
    $pdo->commit();
} catch (\Exception $exception) {
    $pdo->rollback();
}

$person = $repositoryPDO->searchByCpf(new Cpf($data['cpf']));

echo json_encode($person);