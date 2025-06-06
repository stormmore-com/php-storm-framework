<?php

namespace Stormmore\Framework\SourceCode\Scanners;

use Stormmore\Framework\Cqs\CommandHandler;

class CommandHandlerScanner
{
    private HandlerScanner $handlerScanner;

    public function __construct()
    {
        $this->handlerScanner = new HandlerScanner(CommandHandler::class);
    }

    public function scan(array $classes): array
    {
        return $this->handlerScanner->scan($classes);
    }
}