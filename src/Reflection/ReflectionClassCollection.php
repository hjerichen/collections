<?php declare(strict_types=1);

namespace HJerichen\Collections\Reflection;

use HJerichen\Collections\Collection;
use HJerichen\Collections\ObjectCollection;
use ReflectionClass;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 * @extends Collection<ReflectionClass>
 */
class ReflectionClassCollection extends ObjectCollection
{
    /** @param array<int|string,ReflectionClass> $reflectionClasses */
    public function __construct(array $reflectionClasses = [])
    {
        parent::__construct(ReflectionClass::class, $reflectionClasses);
    }

    /** @noinspection PhpRedundantMethodOverrideInspection */
    public function offsetGet($offset): ?ReflectionClass
    {
        return parent::offsetGet($offset);
    }
}