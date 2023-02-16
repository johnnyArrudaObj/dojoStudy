<?php

declare(strict_types=1);


namespace Architecture\Handlers\BankAccount;

use Architecture\Domain\Account\BankAccountDto;
use Architecture\Domain\Account\Command\CreateBankAccountCommand;
use Architecture\Handlers\HandlerInterface;
use Architecture\Utils\Convert\TaxToDepositByCountry;
use InvalidArgumentException;

class CreateBankAccountHandler implements HandlerInterface
{
    private TaxToDepositByCountry $taxToDepositByCountry;

    public function __construct(private readonly CreateBankAccountCommand $createBankAccountCommand) {}

    public function execute(array $options): void
    {
        if (!isset($options[2], $options[3], $options[4])) {
            throw new InvalidArgumentException('Missing parameter');
        }

        $transferData = new BankAccountDto($options[2]);
        $this->createBankAccountCommand->execute($transferData);
    }
}