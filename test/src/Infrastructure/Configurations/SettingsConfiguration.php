<?php

namespace Infrastructure\Configurations;

use Infrastructure\Settings\Settings;
use Stormmore\Framework\Configuration\IConfiguration;
use Stormmore\Framework\Configuration\JsonConfigurationLoader;
use Stormmore\Framework\DependencyInjection\Container;

class SettingsConfiguration implements IConfiguration
{
    public function __construct(private Container $container, private JsonConfigurationLoader $settingsLoader)
    {
    }

    public function configure(): void
    {
        $settings = new Settings();
        $this->settingsLoader->load($settings, '@/settings.json');
        $this->container->register($settings);
    }
}