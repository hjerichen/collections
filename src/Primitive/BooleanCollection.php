<?php declare(strict_types=1);

namespace HJerichen\Collections\Primitive;

use HJerichen\Collections\Collection;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 * @extends Collection<bool>
 */
class BooleanCollection extends Collection
{
    protected function checkType($item): bool
    {
        return is_bool($item) ||
            $item === 1 || $item === 0 ||
            $item === '1' || $item === '0' || $item === ''||
            $item === 'true' || $item === 'false';
    }

    /** @noinspection PhpRedundantMethodOverrideInspection */
    public function offsetGet($offset): ?bool
    {
        return parent::offsetGet($offset);
    }

    public function offsetSet($offset, $value): void
    {
        if ($this->checkType($value)) {
            if ($value === 'false') $value = false;
            $this->offsetSetWithoutCheck($offset, (bool)$value);
        } else {
            $this->throwInvalidTypeException();
        }
    }
}