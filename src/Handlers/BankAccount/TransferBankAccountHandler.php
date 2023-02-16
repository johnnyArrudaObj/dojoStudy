<?php

declare(strict_types=1);


namespace Architecture\Handlers\BankAccount;

use Architecture\Domain\Account\Command\TransferToAccountCommand;
use Architecture\Domain\Account\Transfer\TransferBankAccountDto;
use Architecture\Handlers\HandlerInterface;
use InvalidArgumentException;

class TransferBankAccountHandler implements HandlerInterface
{
    private TransferToAccountCommand $createTransfer;

    public function __construct(TransferToAccountCommand $createTransfer)
    {
        $this->createTransfer = $createTransfer;
    }

    public function execute(array $options): void
    {
        if (!isset($options[2], $options[3], $options[4])) {
            throw new InvalidArgumentException('Missing parameter');
        }

        $transferData = new TransferBankAccountDto($options[2], $options[3], (int)$options[4]);
        $this->createTransfer->execute($transferData);
    }
}