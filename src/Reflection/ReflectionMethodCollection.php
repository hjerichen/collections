<?php

namespace HJerichen\Collections\Reflection;

use HJerichen\Collections\ObjectCollection;
use ReflectionMethod;
use Traversable;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 */
class ReflectionMethodCollection extends ObjectCollection
{
    /**
     * @param array<ReflectionMethod> $reflectionMethods
     */
    public function __construct(array $reflectionMethods = [])
    {
        parent::__construct(ReflectionMethod::class, $reflectionMethods);
    }

    /**
     * @return Traversable | ReflectionMethod[]
     */
    public function getIterator(): Traversable
    {
        return parent::getIterator();
    }
}