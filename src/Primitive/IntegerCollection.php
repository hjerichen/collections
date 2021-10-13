<?php declare(strict_types=1);

namespace HJerichen\Collections\Primitive;

use HJerichen\Collections\Collection;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 * @extends Collection<int>
 */
class IntegerCollection extends Collection
{
    /**
     * @param array-key $offset
     * @return int|null
     */
    public function offsetGet($offset): ?int
    {
        return parent::offsetGet($offset);
    }

    /**
     * @param array-key|null $offset
     * @param int $value
     * @psalm-suppress RedundantCastGivenDocblockType
     */
    public function offsetSet($offset, $value): void
    {
        $this->checkType($value);
        $this->offsetSetWithoutCheck($offset, (int)$value);
    }

    protected function isValidType($item): bool
    {
        return is_int($item) || ((string)$item === (string)(int)$item && !is_bool($item));
    }
}