<?php declare(strict_types=1);

namespace HJerichen\Collections;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 * @template T of object
 * @extends Collection<T>
 */
class ObjectCollection extends Collection
{
    /** @var class-string */
    protected string $type;

    /**
     * @param class-string<T> $type
     * @param array<array-key,T> $items
     */
    public function __construct(string $type, array $items = [])
    {
        $this->type = $type;
        parent::__construct($items);
    }

    protected function isValidType($item): bool
    {
        return $item instanceof $this->type;
    }
}