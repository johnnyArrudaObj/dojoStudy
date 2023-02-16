<?php

declare(strict_types=1);


namespace Architecture\Utils\Convert;

class BrlTax extends AbstractHandler
{
    public function handle(string $currency, int $money): ?int
    {
        return $money;
    }
}