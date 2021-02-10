<?php declare(strict_types=1);

namespace HJerichen\Collections;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 */
class ObjectCollection extends Collection
{
    private string $type;

    public function __construct(string $type, array $items = [])
    {
        $this->type = $type;
        parent::__construct($items);
    }

    protected function checkType($item): bool
    {
        return $item instanceof $this->type;
    }
}