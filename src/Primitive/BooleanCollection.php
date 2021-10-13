<?php declare(strict_types=1);

namespace HJerichen\Collections\Primitive;

use HJerichen\Collections\Collection;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 * @extends Collection<bool>
 */
class BooleanCollection extends Collection
{
    /**
     * @param array-key $offset
     * @return bool|null
     */
    public function offsetGet($offset): ?bool
    {
        return parent::offsetGet($offset);
    }

    /**
     * @param array-key|null $offset
     * @param bool $value
     * @psalm-suppress DocblockTypeContradiction
     * @psalm-suppress RedundantCastGivenDocblockType
     */
    public function offsetSet($offset, $value): void
    {
        $this->checkType($value);

        if ($value === 'false') $value = false;
        $this->offsetSetWithoutCheck($offset, (bool)$value);
    }

    /**
     * @param mixed $item
     * @return bool
     */
    protected function isValidType($item): bool
    {
        return is_bool($item) ||
            $item === 1 || $item === 0 ||
            $item === '1' || $item === '0' || $item === ''||
            $item === 'true' || $item === 'false';
    }
}