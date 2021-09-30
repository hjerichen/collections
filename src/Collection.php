<?php declare(strict_types=1);

namespace HJerichen\Collections;

use ArrayAccess;
use ArrayIterator;
use Countable;
use InvalidArgumentException;
use IteratorAggregate;
use Traversable;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 * @template T
 */
abstract class Collection implements IteratorAggregate, ArrayAccess, Countable
{
    /** @var array<int|string,T> */
    protected array $items = [];

    /** @param array<int|string,T> $items*/
    public function __construct(array $items = [])
    {
        $this->pushMultiple($items);
    }

    /** @param array<int|string,T> $items*/
    public function pushMultiple(array $items): void
    {
        foreach ($items as $key => $item) {
            $this[$key] = $item;
        }
    }

    /** @return Traversable<T>|T[] */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    /**
     * @param int|string $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return isset($this->items[$offset]);
    }

    /**
     * @param int|string $offset
     * @return T|null
     */
    public function offsetGet($offset)
    {
        return $this->items[$offset] ?? null;
    }

    /**
     * @param int|string $offset
     * @param T $value
     */
    public function offsetSet($offset, $value): void
    {
        if ($this->checkType($value)) {
            $this->offsetSetWithoutCheck($offset, $value);
        } else {
            $this->throwInvalidTypeException();
        }
    }

    /**
     * @param int|string $offset
     * @param T $item
     */
    protected function offsetSetWithoutCheck($offset, $item): void
    {
        $offset !== null ? $this->items[$offset] = $item : $this->items[] = $item;
    }

    protected function throwInvalidTypeException(): void
    {
        throw new InvalidArgumentException('invalid type');
    }

    /** @param int|string $offset */
    public function offsetUnset($offset): void
    {
        unset($this->items[$offset]);
    }

    public function count(): int
    {
        return count($this->items);
    }

    /** @return T[] */
    public function asArray(): array
    {
        return $this->items;
    }

    /** @param Collection<T> ...$collections */
    public function merge(Collection ...$collections): void
    {
        $arrays = [];
        foreach ($collections as $collection) {
            $this->checkCollectionForMerge($collection);
            $arrays[] = $collection->asArray();
        }
        $this->items = array_merge($this->items, ...$arrays);
    }

    /** @param Collection<T> $collection */
    private function checkCollectionForMerge(Collection $collection): void
    {
        if ($this->canCollectionBeMerged($collection)) {
            return;
        }
        $message = 'Collections of different types can not be merged.';
        throw new InvalidArgumentException($message);
    }

    /**
     * @param Collection<T> $collection
     * @return bool
     */
    private function canCollectionBeMerged(Collection $collection): bool
    {
        return get_class($this) === get_class($collection);
    }

    /** @param T $item */
    abstract protected function checkType($item): bool;
}