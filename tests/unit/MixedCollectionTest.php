<?php

namespace HJerichen\Collections;

use HJerichen\Collections\TestHelpers\NormalObject;
use PHPUnit\Framework\TestCase;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 */
class MixedCollectionTest extends TestCase
{
    /**
     * @var MixedCollection
     */
    private $collection;

    /**
     *
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->collection = new MixedCollection();
    }


    /* TESTS */

    public function testClassImplementsCorrectInterface(): void
    {
        $this->assertInstanceOf(Collection::class, $this->collection);
    }

    public function testAddToCollection(): void
    {
        $normalObject = new NormalObject();

        $this->collection[] = 'test';
        $this->collection[] = 3;
        $this->collection[] = true;
        $this->collection[] = $normalObject;

        $this->assertSame('test', $this->collection[0]);
        $this->assertSame(3, $this->collection[1]);
        $this->assertSame(true, $this->collection[2]);
        $this->assertSame($normalObject, $this->collection[3]);
    }
}
