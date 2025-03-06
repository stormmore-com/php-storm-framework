<?php

namespace Stormmore\Framework\Classes\Parser;

class PhpClassMethod
{
    public PhpAttributes $attributes;

    public function __construct(public string $access, public string $name, array $attributes = [])
    {
        $this->attributes = new PhpAttributes($attributes);
    }

    public function hasAttribute(string $className): bool
    {
        return $this->attributes->hasAttribute($className);
    }
}