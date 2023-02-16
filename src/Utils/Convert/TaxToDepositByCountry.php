<?php

declare(strict_types=1);

namespace Architecture\Utils\Convert;
class TaxToDepositByCountry
{
    public function execute(): Handler
    {
        $convertEuaCurrency = new EuaTax;
        return $convertEuaCurrency->setNext(new LibraTax)->setNext(new BrlTax);
    }
}