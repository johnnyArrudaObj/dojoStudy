<?php

declare(strict_types=1);

use Architecture\Domain\Account\Command\CreateBankAccountCommand;
use Architecture\Domain\Account\Command\DepositToAccountCommand;
use Architecture\Domain\Account\Command\TransferToAccountCommand;
use Architecture\Domain\Person\DeletePersonCommand;
use Architecture\Domain\Person\UpdatePersonCommand;
use Architecture\Handlers\App;
use Architecture\Handlers\BankAccount\CreateBankAccountHandler;
use Architecture\Handlers\BankAccount\DepositBankAccountHandler;
use Architecture\Handlers\BankAccount\TransferBankAccountHandler;
use Architecture\Handlers\Person\CreatePersonHandler;
use Architecture\Handlers\Person\DeletePersonHandler;
use Architecture\Handlers\Person\UpdatePersonHandler;

if (PHP_SAPI !== 'cli') {
    exit;
}

require __DIR__ . '/../vendor/autoload.php';
$container = require __DIR__ . '/../config/container.php';

$app = new App();

$app->registerCommand('CreatePerson', function (array $argv) use ($app, $container) {
    $commandHandler = $container->get(CreatePersonHandler::class);
    $commandBankAccount = $container->get(CreateBankAccountHandler::class);
    try {
        $commandHandler->execute($argv);
        $commandBankAccount->execute($argv);
        $app->getPrinter()->display("Created User!");
    } catch (\Exception $exception) {
        $app->getPrinter()->display("Error CreatePersonCommand -> " . $exception->getMessage());
    }
});

$app->registerCommand('UpdatePerson', function (array $argv) use ($app, $container) {
    $command = $container->get(UpdatePersonHandler::class);
    try {
        $command->execute($argv);
        $app->getPrinter()->display("Updated User!");
    } catch (\Exception $exception) {
        $app->getPrinter()->display("Error UpdatePersonCommand -> " . $exception->getMessage());
    }
});

$app->registerCommand('DeletePerson', function (array $argv) use ($app, $container) {
    $command = $container->get(DeletePersonHandler::class);
    try {
        $command->execute($argv);
        $app->getPrinter()->display("Deleted User!");
    } catch (\Exception $exception) {
        $app->getPrinter()->display("Error DeletePersonCommand -> " . $exception->getMessage());
    }
});

$app->registerCommand('DepositAmount', function (array $argv) use ($app, $container) {
    $command = $container->get(DepositBankAccountHandler::class);
    try {
        $command->execute($argv);
        $app->getPrinter()->display("Deposit Account!");
    } catch (\Exception $exception) {
        $app->getPrinter()->display("Error CreateAccount -> " . $exception->getMessage());
    }
});

$app->registerCommand('TransferBank', function (array $argv) use ($app, $container) {
    $command = $container->get(TransferBankAccountHandler::class);
    try {
        $command->execute($argv);
        $app->getPrinter()->display("Tranfer money Account!");
    } catch (\Exception $exception) {
        $app->getPrinter()->display("Error Transfer money -> " . $exception->getMessage());
    }
});

$app->runCommand($argv);
