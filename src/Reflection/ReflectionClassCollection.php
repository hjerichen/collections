<?php declare(strict_types=1);

namespace HJerichen\Collections\Reflection;

use HJerichen\Collections\ObjectCollection;
use ReflectionClass;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 * @extends ObjectCollection<ReflectionClass>
 */
class ReflectionClassCollection extends ObjectCollection
{
    /** @param ReflectionClass[] $reflectionClasses */
    public function __construct(array $reflectionClasses = [])
    {
        $class = ReflectionClass::class;
        parent::__construct($class, $reflectionClasses);
    }
}