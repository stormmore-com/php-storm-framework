<?php

namespace Infrastructure\Configuration;

use Stormmore\Framework\AppConfiguration;
use Stormmore\Framework\Configuration\IConfiguration;

readonly class AliasConfiguration implements IConfiguration
{
    public function __construct(private AppConfiguration $appConfiguration)
    {
    }

    public function configure(): void
    {
        $this->appConfiguration->addAliases([
            '@templates' => "@/templates"
        ]);
    }
}