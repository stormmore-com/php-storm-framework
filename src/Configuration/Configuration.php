<?php

namespace Stormmore\Framework\Configuration;

class Configuration
{
    protected array $configuration = [];

    public static function createFromFile(string $filename): Configuration
    {
        $configuration = new Configuration();
        $configuration->loadFile($filename);
        return $configuration;
    }

    public function set(string $name, string $value)
    {
        $this->configuration[$name] = $value;
    }

    public function loadFile(string $file): void
    {
        $confFileLoader = new ConfFileLoader($file);
        $this->configuration = array_merge($this->configuration, $confFileLoader->parse());
    }

    public function has(string $name): bool
    {
        return array_key_exists($name, $this->configuration);
    }

    public function get(string $name, mixed $defaultValue = null): mixed
    {
        if (!array_key_exists($name, $this->configuration)) {
            return $defaultValue;
        }
        return $this->configuration[$name];
    }

    public function getBool(string $name): bool
    {
        if (array_key_exists($name, $this->configuration)) {
            $value =  strtolower($this->configuration[$name]);
            return in_array($value, ["1", "true", "yes"]);
        }
        return false;
    }

    public function getArray(string $name): array
    {
        if (array_key_exists($name, $this->configuration)) {
            $value = $this->configuration[$name];
            return array_map(fn($item) => trim($item), explode(',', $value));
        }

        return [];
    }
}