<?php declare(strict_types=1);

namespace HJerichen\Collections\Reflection;

use HJerichen\Collections\ObjectCollection;
use ReflectionClass;
use Traversable;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 */
class ReflectionClassCollection extends ObjectCollection
{
    public function __construct(array $reflectionClasses = [])
    {
        parent::__construct(ReflectionClass::class, $reflectionClasses);
    }

    /**
     * @return Traversable | ReflectionClass[]
     */
    public function getIterator(): Traversable
    {
        return parent::getIterator();
    }

    public function offsetGet($offset): ?ReflectionClass
    {
        return parent::offsetGet($offset);
    }
}