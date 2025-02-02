<?php declare(strict_types=1);

namespace HJerichen\Collections;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 * @template T of object
 * @extends Collection<T>
 */
class ObjectCollection extends Collection
{
    /** @var class-string<T> */
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

    /** @return class-string<T> */
    public function getType(): string
    {
        return $this->type;
    }

    protected function isValidType(mixed $item): bool
    {
        return $item instanceof $this->type;
    }
}