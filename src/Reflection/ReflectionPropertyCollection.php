<?php declare(strict_types=1);

namespace HJerichen\Collections\Reflection;

use HJerichen\Collections\ObjectCollection;
use ReflectionProperty;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 * @extends ObjectCollection<ReflectionProperty>
 */
class ReflectionPropertyCollection extends ObjectCollection
{
    /** @param array<array-key,ReflectionProperty> $reflectionProperties */
    public function __construct(array $reflectionProperties = [])
    {
        parent::__construct(ReflectionProperty::class, $reflectionProperties);
    }
}