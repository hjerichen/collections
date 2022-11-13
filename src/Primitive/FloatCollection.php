<?php declare(strict_types=1);

namespace HJerichen\Collections\Primitive;

use HJerichen\Collections\Collection;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 * @extends Collection<float>
 */
class FloatCollection extends Collection
{
    public function getType(): string
    {
        return 'float';
    }

    /**
     * @param array-key $offset
     * @return float|null
     */
    public function offsetGet($offset): ?float
    {
        return parent::offsetGet($offset);
    }

    /**
     * @param array-key|null $offset
     * @param float $value
     * @psalm-suppress RedundantCastGivenDocblockType
     */
    public function offsetSet($offset, $value): void
    {
        $this->checkType($value);
        $this->offsetSetWithoutCheck($offset, (float)$value);
    }

    protected function isValidType($item): bool
    {
        return is_numeric($item);
    }
}