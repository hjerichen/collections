<?php declare(strict_types=1);

namespace HJerichen\Collections\Reflection;

use HJerichen\Collections\Collection;
use HJerichen\Collections\ObjectCollection;
use ReflectionProperty;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 * @extends Collection<ReflectionProperty>
 * @extends ObjectCollection<ReflectionProperty>
 */
class ReflectionPropertyCollection extends ObjectCollection
{
    /** @param array<array-key,ReflectionProperty> $reflectionProperties */
    public function __construct(array $reflectionProperties = [])
    {
        parent::__construct(ReflectionProperty::class, $reflectionProperties);
    }

    /** @noinspection PhpRedundantMethodOverrideInspection */
    public function offsetGet($offset): ?ReflectionProperty
    {
        return parent::offsetGet($offset);
    }
}