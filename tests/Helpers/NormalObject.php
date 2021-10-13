<?php declare(strict_types=1);

namespace HJerichen\Collections\Test\Helpers;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 */
class NormalObject
{
    public int $id;
    public string $name;

    public function __construct(int $id = 0)
    {
        $this->id = $id;
        $this->name = '';
    }
}