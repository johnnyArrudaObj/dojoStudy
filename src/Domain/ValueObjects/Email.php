<?php

declare(strict_types=1);

namespace Architecture\Domain\ValueObjects;

class Email
{
    private string $email;

    public function __construct(string $mail)
    {
        if (filter_var($mail, FILTER_VALIDATE_EMAIL) === false) {
            throw new \InvalidArgumentException('E-mail invalid');
        }

        $this->email = $mail;
    }

    public function __toString(): string
    {
        return $this->email;
    }
}
