<?php

declare(strict_types=1);


namespace Architecture\Utils\Convert;

class LibraTax extends AbstractHandler
{
    public function handle(string $currency, int $money): ?int
    {
        if ($currency !== "Libra") {
            return parent::handle($currency, $money);
        }

        return $money + 20;
    }
}