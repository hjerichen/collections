<?php

namespace HJerichen\Collections\Primitive;

use HJerichen\Collections\Collection;
use HJerichen\Collections\TestHelpers\NormalObject;
use HJerichen\Collections\TestHelpers\StringObject;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 */
class StringCollectionTest extends TestCase
{
    /**
     * @var StringCollection
     */
    private $collection;

    /**
     *
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->collection = new StringCollection();
    }


    /* TESTS */

    public function testClassImplementsCorrectInterface(): void
    {
        $this->assertInstanceOf(Collection::class, $this->collection);
    }

    public function testAddString(): void
    {
        $this->collection[] = 'test';

        $expected = 'test';
        $actual = $this->collection[0];
        $this->assertEquals($expected, $actual);
    }

    public function testAddInteger(): void
    {
        $this->collection[] = 2;

        $expected = '2';
        $actual = $this->collection[0];
        $this->assertSame($expected, $actual);
    }

    public function testAddStringObject(): void
    {
        $this->collection[] = new StringObject('test');

        $expected = 'test';
        $actual = $this->collection[0];
        $this->assertSame($expected, $actual);
    }

    public function testAddNormalObject(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->collection[] = new NormalObject();
    }

    public function testAddTrue(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->collection[] = true;
    }

    public function testAddFalse(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->collection[] = false;
    }

    public function testAddArray(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->collection[] = [];
    }

    public function testGettingIterator(): void
    {
        $this->collection[] = 'test';

        $expected = 'test';
        $actual = $this->collection->getIterator()->current();
        $this->assertSame($expected, $actual);
    }
}
