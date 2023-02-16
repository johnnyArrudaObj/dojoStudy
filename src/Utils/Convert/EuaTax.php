<?php

declare(strict_types=1);


namespace Architecture\Utils\Convert;

class EuaTax extends AbstractHandler
{
    public function handle(string $currency, int $money): ?int
    {
        if ($currency !== "EUA") {
            return parent::handle($currency, $money);
        }

        return $money + 10;
    }
}