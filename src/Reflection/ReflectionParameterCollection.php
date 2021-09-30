<?php declare(strict_types=1);

namespace HJerichen\Collections\Reflection;

use HJerichen\Collections\Collection;
use HJerichen\Collections\ObjectCollection;
use ReflectionParameter;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 * @extends Collection<ReflectionParameter>
 */
class ReflectionParameterCollection extends ObjectCollection
{
    /** @param array<int|string,ReflectionParameter> $reflectionParameters */
    public function __construct(array $reflectionParameters = [])
    {
        parent::__construct(ReflectionParameter::class, $reflectionParameters);
    }
}