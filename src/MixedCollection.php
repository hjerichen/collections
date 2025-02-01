<?php declare(strict_types=1);

namespace HJerichen\Collections;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 * @extends Collection<mixed>
 */
class MixedCollection extends Collection
{
    public function getType(): string
    {
        return 'mixed';
    }

    protected function isValidType(mixed $item): bool
    {
        return true;
    }
}