<?php declare(strict_types=1);

namespace HJerichen\Collections\Test\Unit\Primitive;

use HJerichen\Collections\Collection;
use HJerichen\Collections\Primitive\IntegerCollection;
use PHPUnit\Framework\TestCase;
use TypeError;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 */
class IntegerCollectionTest extends TestCase
{
    private IntegerCollection $collection;

    protected function setUp(): void
    {
        parent::setUp();

        $this->collection = new IntegerCollection();
    }


    /* TESTS */

    public function testClassImplementsCorrectInterface(): void
    {
        self::assertInstanceOf(Collection::class, $this->collection);
    }

    public function testGetType(): void
    {
        $expected = 'int';
        $actual = $this->collection->getType();
        $this->assertEquals($expected, $actual);
    }

    public function testAddInteger(): void
    {
        $this->collection[] = 45;

        $expected = 45;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    /** @psalm-suppress InvalidArgument */
    public function testAddIntegerAsString(): void
    {
        $this->collection[] = '45';

        $expected = 45;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    public function testAddZero(): void
    {
        $this->collection[] = 0;

        $expected = 0;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    /** @psalm-suppress InvalidArgument */
    public function testAddZeroAsString(): void
    {
        $this->collection[] = '0';

        $expected = 0;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    public function testAddNegativeInteger(): void
    {
        $this->collection[] = -10;

        $expected = -10;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    /** @psalm-suppress InvalidArgument */
    public function testAddNegativeIntegerAsString(): void
    {
        $this->collection[] = '-10';

        $expected = -10;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    /** @psalm-suppress InvalidArgument */
    public function testAddFloat(): void
    {
        $this->expectException(TypeError::class);

        $this->collection[] = 44.6;
    }

    /** @psalm-suppress InvalidArgument */
    public function testAddFloatAsString(): void
    {
        $this->expectException(TypeError::class);

        $this->collection[] = '44.6';
    }

    /** @psalm-suppress InvalidArgument */
    public function testAddString(): void
    {
        $this->expectException(TypeError::class);

        $this->collection[] = 'true';
    }

    /** @psalm-suppress InvalidArgument */
    public function testAddTrue(): void
    {
        $this->expectException(TypeError::class);

        $this->collection[] = true;
    }

    /** @psalm-suppress InvalidArgument */
    public function testAddFalse(): void
    {
        $this->expectException(TypeError::class);

        $this->collection[] = false;
    }

    public function testGettingIterator(): void
    {
        $this->collection[] = 3;

        foreach ($this->collection as $item) {
            $expected = 3;
            $actual = $item;
            self::assertSame($expected, $actual);
        }
    }
}
