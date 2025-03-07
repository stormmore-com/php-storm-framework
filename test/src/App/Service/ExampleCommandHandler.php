<?php

namespace Configuration;

use Stormmore\Framework\Cqs\CommandHandler;
use Stormmore\Framework\Cqs\ICommandHandler;

#[CommandHandler(ExampleCommand::class)]
class ExampleCommandHandler implements ICommandHandler
{
    public function handle(ExampleCommand $command): void
    {
    }
}