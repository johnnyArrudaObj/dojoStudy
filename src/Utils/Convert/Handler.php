<?php

namespace Architecture\Utils\Convert;

interface Handler
{
    public function setNext(Handler $handler): Handler;

    public function handle(string $currency, int $money): ?int;
}