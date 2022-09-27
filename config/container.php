<?php

declare(strict_types=1);

use Architecture\Domain\Person\PersonRepository;
use Architecture\Infrastructure\Repository\RepositoryPDO;
use DI\ContainerBuilder;
use function DI\create;
use function DI\get;

$pathDataBase = __DIR__ . '/../dataBase.sqlite';
$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([
    PDO::class => create(PDO::class)->constructor("sqlite:$pathDataBase"),
    PersonRepository::class => get(RepositoryPDO::class),
]);

try {
    return $containerBuilder->build();
} catch (Exception $e) {
    var_dump($e->getMessage());
    exit();
}