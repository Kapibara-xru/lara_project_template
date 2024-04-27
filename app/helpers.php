<?php

use Illuminate\Support\Collection;
use Illuminate\Support\Arr;

if (! function_exists('getReflectionAttrByClass')) {
    /**
     * @throws ReflectionException
     */
    function getReflectionAttrByClass($class): Collection
    {
        $reflectionClass = new ReflectionClass($class);

        return collect($reflectionClass->getAttributes())
            ->map(fn ($attr) => ([$attr->getName() => Arr::first($attr->getArguments())]));
    }
}

if (! function_exists('getReflectionAttribute')) {
    /**
     * @param  class-string  $class
     * @param  class-string|null  $attribute
     * @param  class-string|null  $default
     * @return class-string|null
     *
     * @throws ReflectionException
     */
    function getReflectionAttribute(string $class, string $attribute = null, string $default = null): ?string
    {
        $reflection = getReflectionAttrByClass($class);

        if (! $attribute) {
            return $reflection;
        }

        return $reflection->value($attribute, $default);
    }
}
