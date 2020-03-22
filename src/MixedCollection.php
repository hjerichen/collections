<?php declare(strict_types=1);

namespace HJerichen\Collections;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 */
class MixedCollection extends Collection
{
    protected function checkType($item): bool
    {
        return true;
    }
}