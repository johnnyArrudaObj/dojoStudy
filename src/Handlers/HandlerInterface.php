<?php

declare(strict_types=1);

namespace Architecture\Handlers;

interface HandlerInterface
{
    public function execute(array $options);
}