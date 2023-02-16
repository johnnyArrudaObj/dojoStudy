<?php

declare(strict_types=1);

namespace Architecture\Infrastructure\Repository\BankAccount;

use Architecture\Domain\Account\BankAccount;
use Architecture\Domain\Account\OperationsAccountRepository;
use Architecture\Domain\ValueObjects\Cpf;
use PDO;

class AccountRepositoryAccountRepositoryPDO implements OperationsAccountRepository
{
    private BankAccountMapping $serviceBankAccount;

    public function __construct(private readonly PDO $connection)
    {
        $this->serviceBankAccount = new BankAccountMapping();
    }

    public function add(BankAccount $bankAccount): BankAccount
    {
        $stmt = $this->connection->prepare(
            'INSERT INTO bank_account (cpf, balance) VALUES (:cpf, :balance);'
        );

        $stmt->bindValue(':cpf', $bankAccount->getCpfCustomer());
        $stmt->bindValue(':balance', $bankAccount->getBalance());

        $stmt->execute();

        return $bankAccount;
    }

    public function get(Cpf $cpf): BankAccount
    {
        $stmt = $this->connection->prepare(
            'SELECT id, cpf, balance FROM bank_account WHERE bank_account.cpf = ?;'
        );

        $stmt->bindValue(1, $cpf);
        $stmt->execute();

        return $this->serviceBankAccount->mapBankAccount(
            $stmt->fetchAll(\PDO::FETCH_ASSOC),
            $cpf
        );
    }

    public function update(BankAccount $bankAccount): BankAccount
    {
        $stmt = $this->connection->prepare(
            'UPDATE bank_account SET balance = ? WHERE bank_account.cpf = ?;'
        );

        $stmt->bindValue(1, $bankAccount->getBalance());
        $stmt->bindValue(2, $bankAccount->getCpfCustomer());

        $stmt->execute();

        return $bankAccount;
    }
}
