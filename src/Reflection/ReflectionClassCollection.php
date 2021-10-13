<?php declare(strict_types=1);

namespace HJerichen\Collections\Reflection;

use HJerichen\Collections\Collection;
use HJerichen\Collections\ObjectCollection;
use ReflectionClass;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 * @extends Collection<ReflectionClass>
 * @extends ObjectCollection<ReflectionClass>
 * @psalm-suppress InvalidDocblock
 */
class ReflectionClassCollection extends ObjectCollection
{
    /** @param ReflectionClass[] $reflectionClasses */
    public function __construct(array $reflectionClasses = [])
    {
        /** @var class-string<ReflectionClass<object>> $class */
        $class = ReflectionClass::class;
        parent::__construct($class, $reflectionClasses);
    }

    /** @noinspection PhpRedundantMethodOverrideInspection */
    public function offsetGet($offset): ?ReflectionClass
    {
        return parent::offsetGet($offset);
    }
}