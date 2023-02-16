<?php

declare(strict_types=1);


use Architecture\Domain\Account\Command\CreateBankAccountCommand;
use Architecture\Domain\Account\Command\DepositToAccountCommand;
use Architecture\Domain\Account\Command\TransferToAccountCommand;
use Architecture\Domain\Account\Deposit\DepositToAccountSevice;
use Architecture\Domain\Account\OperationsAccountRepository;
use Architecture\Domain\Account\Transfer\TransferToAccountSevice;
use Architecture\Domain\Person\Command\CreatePersonCommand;
use Architecture\Domain\Person\Command\DeletePersonCommand;
use Architecture\Domain\Person\Command\UpdatePersonCommand;
use Architecture\Domain\Person\PersonRepository;
use Architecture\Handlers\BankAccount\CreateBankAccountHandler;
use Architecture\Handlers\BankAccount\DepositBankAccountHandler;
use Architecture\Handlers\BankAccount\TransferBankAccountHandler;
use Architecture\Handlers\Person\CreatePersonHandler;
use Architecture\Handlers\Person\DeletePersonHandler;
use Architecture\Handlers\Person\UpdatePersonHandler;
use Architecture\Infrastructure\Repository\BankAccount\AccountRepositoryAccountRepositoryPDO;
use Architecture\Infrastructure\Repository\Person\PersonRepositoryPDO;
use DI\ContainerBuilder;
use function DI\create;
use function DI\get;

$pathDataBase = __DIR__ . '/../dataBase.sqlite';
$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([
    PDO::class => create(PDO::class)->constructor("sqlite:$pathDataBase"),
    //Interfaces
    PersonRepository::class => get(PersonRepositoryPDO::class),
    OperationsAccountRepository::class => get(AccountRepositoryAccountRepositoryPDO::class),

    //Create Person
    CreatePersonCommand::class => create()->constructor(get(PersonRepository::class)),
    CreatePersonHandler::class => create()->constructor(get(CreatePersonCommand::class)),
    //Update Person
    UpdatePersonCommand::class => create()->constructor(get(PersonRepository::class)),
    UpdatePersonHandler::class => create()->constructor(get(UpdatePersonCommand::class)),
    //Delet Person
    DeletePersonCommand::class => create()->constructor(get(PersonRepository::class)),
    DeletePersonHandler::class => create()->constructor(get(DeletePersonCommand::class)),

    //Create Bank Account
    CreateBankAccountCommand::class => create()->constructor(get(OperationsAccountRepository::class)),
    CreateBankAccountHandler::class => create()->constructor(get(CreateBankAccountCommand::class)),
    //Deposit Bank Account
    DepositToAccountSevice::class => create()->constructor(get(OperationsAccountRepository::class)),
    DepositToAccountCommand::class => create()->constructor(get(DepositToAccountSevice::class)),
    DepositBankAccountHandler::class => create()->constructor(get(DepositToAccountCommand::class)),
    //Transfer Bank Account
    TransferToAccountSevice::class => create()->constructor(get(OperationsAccountRepository::class)),
    TransferToAccountCommand::class => create()->constructor(get(TransferToAccountSevice::class)),
    TransferBankAccountHandler::class => create()->constructor(get(TransferToAccountCommand::class)),
]);

try {
    return $containerBuilder->build();
} catch (Exception $e) {
    var_dump($e->getMessage());
    exit();
}