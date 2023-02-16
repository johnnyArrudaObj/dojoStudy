<?php

declare(strict_types=1);

namespace Architecture\Infrastructure\Repository\BankAccount;

use Architecture\Domain\Account\BankAccount;
use Architecture\Domain\Account\BankAccountNotFound;
use Architecture\Domain\ValueObjects\Cpf;

class BankAccountMapping
{
    /**
     * @param array<array<string>> $listOfBankAccounts
     * @return array<BankAccount>
     */
    public function mapBankAccounts(array $listOfBankAccounts): array
    {
        $persons = [];

        foreach ($listOfBankAccounts as $dataBankAccount) {
            if (!array_key_exists($dataBankAccount['cpf'], $persons)) {
                $persons[$dataBankAccount['cpf']] = $this->buildBankAccount($dataBankAccount);
            }
        }

        return array_values($persons);
    }

    /**
     * @param array<array<string>> $listOfBankAccount
     * @param Cpf $cpf
     * @return BankAccount
     */
    public function mapBankAccount(array $listOfBankAccount, Cpf $cpf): BankAccount
    {
        if (count($listOfBankAccount) === 0) {
            throw new BankAccountNotFound($cpf);
        }

        $firstBankAccount = $listOfBankAccount[0];

        return $this->buildBankAccount($firstBankAccount);
    }

    /**
     * @param array<string> $dataBankAccount
     * @return BankAccount
     */
    private function buildBankAccount(array $dataBankAccount): BankAccount
    {
        return BankAccount::buildBankAccount(
            $dataBankAccount['cpf'],
            (int)$dataBankAccount['balance']
        );
    }
}
