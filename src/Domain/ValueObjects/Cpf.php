<?php

declare(strict_types=1);

namespace Architecture\Domain\ValueObjects;

class Cpf
{
    private string $cpf;

    public function __construct(string $value)
    {
        $this->setCpf($value);
    }

    private function setCpf(string $value): void
    {
        $optionsRegex = [
            'options' => [
                'regexp' => '/\d{3}\.\d{3}\.\d{3}\-\d{2}/'
            ]
        ];
        if (filter_var($value, FILTER_VALIDATE_REGEXP, $optionsRegex) === false) {
            throw new \InvalidArgumentException('CPF not valid');
        }

        $this->cpf = $value;
    }

    public function __toString(): string
    {
        return $this->cpf;
    }
}
