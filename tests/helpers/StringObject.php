<?php

namespace HJerichen\Collections\TestHelpers;

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