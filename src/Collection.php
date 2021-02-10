<?php declare(strict_types=1);

namespace HJerichen\Collections;

use ArrayAccess;
use ArrayIterator;
use Countable;
use InvalidArgumentException;
use IteratorAggregate;
use Traversable;

abstract class Collection implements IteratorAggregate, ArrayAccess, Countable
{
    private array $items = [];

    public function __construct(array $items = [])
    {
        $this->pushMultiple($items);
    }

    public function pushMultiple(array $items): void
    {
        foreach ($items as $key => $item) {
            $this[$key] = $item;
        }
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    public function offsetExists($offset): bool
    {
        return isset($this->items[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->items[$offset] ?? null;
    }

    public function offsetSet($offset, $value): void
    {
        if ($this->checkType($value)) {
            $this->offsetSetWithoutCheck($offset, $value);
        } else {
            $this->throwInvalidTypeException();
        }
    }

    protected function offsetSetWithoutCheck($offset, $item): void
    {
        $offset !== null ? $this->items[$offset] = $item : $this->items[] = $item;
    }

    protected function throwInvalidTypeException(): void
    {
        throw new InvalidArgumentException('invalid type');
    }

    public function offsetUnset($offset): void
    {
        unset($this->items[$offset]);
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function asArray(): array
    {
        return $this->items;
    }

    public function merge(Collection ...$collections): void
    {
        $arrays = [];
        foreach ($collections as $collection) {
            $this->checkCollectionForMerge($collection);
            $arrays[] = $collection->asArray();
        }
        $this->items = array_merge($this->items, ...$arrays);
    }

    private function checkCollectionForMerge(Collection $collection): void
    {
        if ($this->canCollectionBeMerged($collection)) {
            return;
        }
        $message = 'Collections of different types can not be merged.';
        throw new InvalidArgumentException($message);
    }

    private function canCollectionBeMerged(Collection $collection): bool
    {
        return get_class($this) === get_class($collection);
    }

    abstract protected function checkType($item): bool;
}