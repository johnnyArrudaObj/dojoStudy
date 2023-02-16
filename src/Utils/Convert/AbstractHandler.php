<?php

declare(strict_types=1);


namespace Architecture\Utils\Convert;

abstract class AbstractHandler implements Handler
{
    private Handler $nextHandler;

    public function setNext(Handler $handler): Handler
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function handle(string $currency, int $money): ?int
    {
        return $this->nextHandler?->handle($currency, $money);
    }
}
