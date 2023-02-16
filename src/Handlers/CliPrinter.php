<?php

declare(strict_types=1);

namespace Architecture\Handlers;
class CliPrinter
{
    public function out($message): void
    {
        echo $message;
    }

    public function newline(): void
    {
        $this->out("\n");
    }

    public function display($message): void
    {
        $this->newline();
        $this->out($message);
        $this->newline();
        $this->newline();
    }
}