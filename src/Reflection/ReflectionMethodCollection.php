<?php declare(strict_types=1);

namespace HJerichen\Collections\Reflection;

use HJerichen\Collections\ObjectCollection;
use ReflectionMethod;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 * @extends ObjectCollection<ReflectionMethod>
 */
class ReflectionMethodCollection extends ObjectCollection
{
    /** @param array<array-key,ReflectionMethod> $reflectionMethods */
    public function __construct(array $reflectionMethods = [])
    {
        parent::__construct(ReflectionMethod::class, $reflectionMethods);
    }
}