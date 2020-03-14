<?php

namespace HJerichen\Collections\Primitive;

use HJerichen\Collections\Collection;
use HJerichen\Collections\TestHelpers\NormalObject;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 */
class BooleanCollectionTest extends TestCase
{
    /**
     * @var BooleanCollection
     */
    private $collection;

    /**
     *
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->collection = new BooleanCollection();
    }

    public function testClassImplementsCorrectInterface(): void
    {
        $this->assertInstanceOf(Collection::class, $this->collection);
    }


    /* TESTS */

    public function testAddTrue(): void
    {
        $this->collection[] = true;

        $expected = true;
        $actual = $this->collection[0];
        $this->assertSame($expected, $actual);
    }

    public function testAddFalse(): void
    {
        $this->collection[] = false;

        $expected = false;
        $actual = $this->collection[0];
        $this->assertSame($expected, $actual);
    }

    public function testAddOne(): void
    {
        $this->collection[] = 1;

        $expected = true;
        $actual = $this->collection[0];
        $this->assertSame($expected, $actual);
    }

    public function testAddZero(): void
    {
        $this->collection[] = 0;

        $expected = false;
        $actual = $this->collection[0];
        $this->assertSame($expected, $actual);
    }

    public function testAddOneAsString(): void
    {
        $this->collection[] = '1';

        $expected = true;
        $actual = $this->collection[0];
        $this->assertSame($expected, $actual);
    }

    public function testAddZeroAsString(): void
    {
        $this->collection[] = '0';

        $expected = false;
        $actual = $this->collection[0];
        $this->assertSame($expected, $actual);
    }

    public function testAddEmptyString(): void
    {
        $this->collection[] = '';

        $expected = false;
        $actual = $this->collection[0];
        $this->assertSame($expected, $actual);
    }

    public function testAddTrueString(): void
    {
        $this->collection[] = 'true';

        $expected = true;
        $actual = $this->collection[0];
        $this->assertSame($expected, $actual);
    }

    public function testAddFalseString(): void
    {
        $this->collection[] = 'false';

        $expected = false;
        $actual = $this->collection[0];
        $this->assertSame($expected, $actual);
    }

    public function testAddSomeString(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->collection[] = 'test';
    }

    public function testAddSomeInteger(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->collection[] = 2;
    }

    public function testAddSomeFloat(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->collection[] = 2.6;
    }

    public function testAddArray(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->collection[] = [];
    }

    public function testAddObject(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->collection[] = new NormalObject();
    }

    public function testGettingIterator(): void
    {
        $this->collection[] = true;

        $expected = true;
        $actual = $this->collection->getIterator()->current();
        $this->assertSame($expected, $actual);
    }


    /* HELPERS */
}
