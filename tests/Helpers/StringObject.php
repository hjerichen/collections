<?php declare(strict_types=1);

namespace HJerichen\Collections\Test\Helpers;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 */
class StringObject
{
    /**
     * @var string
     */
    private $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function __toString(): string
    {
        return $this->text;
    }
}