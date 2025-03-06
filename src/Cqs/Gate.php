<?php

namespace Stormmore\Framework\Cqs;

use Stormmore\Framework\Classes\SourceCode;
use Stormmore\Framework\DependencyInjection\Resolver;
use Exception;

readonly class Gate
{
    public function __construct(private SourceCode $sourceCode, private Resolver $resolver)
    {
    }

    public function handle(object $command): void
    {
        $handler = $this->getCommandHandler($command);
        $handler != null or throw new Exception("Gate: Handle for {$command} not found.");
        method_exists($handler, 'handle') or throw new Exception("Gate: handler " . get_class($handler) . " doest not implement handle function");
        $handler->handle($command);
    }

    private function getCommandHandler(object $command): null|object
    {
        foreach($this->sourceCode->getCommandHandlers() as $fullyQualifiedHandlerName => $commandQualifiedName) {
            if ($commandQualifiedName == get_class($command)) {
                return $this->resolver->resolveObject($fullyQualifiedHandlerName);
            }
        }
        return null;
    }
}