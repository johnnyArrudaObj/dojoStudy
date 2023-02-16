<?php

declare(strict_types=1);

namespace Architecture\Domain\Account;

use Architecture\Domain\ValueObjects\Cpf;

final class BankAccount
{
    public static function buildBankAccount(string $cpf, int $balance): self
    {
        return new BankAccount(new Cpf($cpf), $balance);
    }

    private function __construct(private Cpf $cpfCustomer, private int $balance) {}

    /**
     * @return Cpf
     */
    public function getCpfCustomer(): Cpf
    {
        return $this->cpfCustomer;
    }

    /**
     * @param Cpf $cpfCustomer
     */
    public function setCpfCustomer(Cpf $cpfCustomer): void
    {
        $this->cpfCustomer = $cpfCustomer;
    }

    /**
     * @return int
     */
    public function getBalance(): int
    {
        return $this->balance;
    }

    /**
     * @param int $balance
     */
    public function setBalance(int $balance): void
    {
        $this->balance = $balance;
    }
}