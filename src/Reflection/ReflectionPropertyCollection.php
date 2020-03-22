<?php declare(strict_types=1);

namespace HJerichen\Collections\Reflection;

use HJerichen\Collections\ObjectCollection;
use ReflectionProperty;
use Traversable;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 */
class ReflectionPropertyCollection extends ObjectCollection
{
    public function __construct(array $reflectionProperties = [])
    {
        parent::__construct(ReflectionProperty::class, $reflectionProperties);
    }

    /**
     * @return Traversable | ReflectionProperty[]
     */
    public function getIterator(): Traversable
    {
        return parent::getIterator();
    }
}