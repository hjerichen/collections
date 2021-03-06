<?php declare(strict_types=1);

namespace HJerichen\Collections\Reflection;

use HJerichen\Collections\ObjectCollection;
use ReflectionParameter;
use Traversable;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 */
class ReflectionParameterCollection extends ObjectCollection
{
    public function __construct(array $reflectionParameters = [])
    {
        parent::__construct(ReflectionParameter::class, $reflectionParameters);
    }

    /**
     * @return Traversable | ReflectionParameter[]
     */
    public function getIterator(): Traversable
    {
        return parent::getIterator();
    }

    public function offsetGet($offset): ?ReflectionParameter
    {
        return parent::offsetGet($offset);
    }
}