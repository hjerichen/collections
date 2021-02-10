<?php declare(strict_types=1);

namespace HJerichen\Collections\Primitive;

use HJerichen\Collections\Collection;
use Traversable;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 */
class IntegerCollection extends Collection
{
    protected function checkType($item): bool
    {
        return is_int($item) || ((string)$item === (string)(int)$item && !is_bool($item));
    }

    /**
     * @return Traversable | int[]
     */
    public function getIterator(): Traversable
    {
        return parent::getIterator();
    }

    public function offsetGet($offset): ?int
    {
        return parent::offsetGet($offset);
    }

    public function offsetSet($offset, $value): void
    {
        if ($this->checkType($value)) {
            $this->offsetSetWithoutCheck($offset, (int)$value);
        } else {
            $this->throwInvalidTypeException();
        }
    }
}