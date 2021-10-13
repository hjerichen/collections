<?php declare(strict_types=1);

namespace HJerichen\Collections;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 * @extends Collection<mixed>
 */
class MixedCollection extends Collection
{
    protected function isValidType($item): bool
    {
        return true;
    }
}