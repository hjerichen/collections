<?php declare(strict_types=1);

namespace HJerichen\Collections\Primitive;

use HJerichen\Collections\Collection;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 * @extends Collection<float>
 */
class FloatCollection extends Collection
{
    protected function checkType($item): bool
    {
        return is_numeric($item);
    }

    /** @noinspection PhpRedundantMethodOverrideInspection */
    public function offsetGet($offset): ?float
    {
        return parent::offsetGet($offset);
    }

    public function offsetSet($offset, $value): void
    {
        if ($this->checkType($value)) {
            $this->offsetSetWithoutCheck($offset, (float)$value);
        } else {
            $this->throwInvalidTypeException();
        }
    }
}