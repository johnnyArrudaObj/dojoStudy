<?php

declare(strict_types=1);

namespace Architecture\Handlers;

class App
{
    protected CliPrinter $printer;

    protected array $registry = [];

    public function __construct()
    {
        $this->printer = new CliPrinter();
    }

    public function getPrinter(): CliPrinter
    {
        return $this->printer;
    }

    public function registerCommand(string $name, callable $callable): void
    {
        $this->registry[$name] = $callable;
    }

    public function getCommand($command)
    {
        return $this->registry[$command] ?? null;
    }

    public function runCommand(array $argv = []): void
    {
        $command_name = $argv[1] ?? "";

        $command = $this->getCommand($command_name);
        if ($command === null) {
            $this->getPrinter()->display("ERROR: Handlers \"$command_name\" not found.");
            exit;
        }

        $command($argv);
    }
}