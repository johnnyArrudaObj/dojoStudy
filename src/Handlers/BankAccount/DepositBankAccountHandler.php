<?php

declare(strict_types=1);


namespace Architecture\Handlers\BankAccount;

use Architecture\Domain\Account\Command\DepositToAccountCommand;
use Architecture\Domain\Account\Deposit\DepositBankAccountDto;
use Architecture\Handlers\HandlerInterface;
use Architecture\Utils\Convert\TaxToDepositByCountry;
use InvalidArgumentException;

class DepositBankAccountHandler implements HandlerInterface
{
    private TaxToDepositByCountry $taxToDepositByCountry;

    public function __construct(private readonly DepositToAccountCommand $depositTransfer) {
        $this->taxToDepositByCountry = new TaxToDepositByCountry();
    }

    public function execute(array $options): void
    {
        if (!isset($options[2], $options[3], $options[4])) {
            throw new InvalidArgumentException('Missing parameter');
        }

        $amountConverted = (int)$this->taxToDepositByCountry->execute()->handle($options[3], (int)$options[4]);

        $transferData = new DepositBankAccountDto($options[2], $amountConverted);
        $this->depositTransfer->execute($transferData);
    }
}