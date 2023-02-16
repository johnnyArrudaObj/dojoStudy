<?php

declare(strict_types=1);

namespace Architecture\Domain\Person;

use Architecture\Domain\ValueObjects\Cpf;
use Architecture\Domain\ValueObjects\Email;

final class Person
{
    public static function buildPerson(string $cpf, string $name, string $email): self
    {
        return new Person(new Cpf($cpf), $name, new Email($email));
    }

    private function __construct(private Cpf $cpf, private string $name, private Email $email) {}

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Cpf
     */
    public function getCpf(): Cpf
    {
        return $this->cpf;
    }

    /**
     * @param Cpf $cpf
     */
    public function setCpf(Cpf $cpf): void
    {
        $this->cpf = $cpf;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @param Email $email
     */
    public function setEmail(Email $email): void
    {
        $this->email = $email;
    }
}
