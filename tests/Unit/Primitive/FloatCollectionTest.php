<?php declare(strict_types=1);

namespace HJerichen\Collections\Test\Unit\Primitive;

use HJerichen\Collections\Collection;
use HJerichen\Collections\Primitive\FloatCollection;
use PHPUnit\Framework\TestCase;
use TypeError;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 */
class FloatCollectionTest extends TestCase
{
    private FloatCollection $collection;

    protected function setUp(): void
    {
        parent::setUp();

        $this->collection = new FloatCollection();
    }


    /* TESTS */

    public function testClassImplementsCorrectInterface(): void
    {
        self::assertInstanceOf(Collection::class, $this->collection);
    }

    public function testGetType(): void
    {
        $expected = 'float';
        $actual = $this->collection->getType();
        $this->assertEquals($expected, $actual);
    }

    public function testInitializeWithFloat(): void
    {
        $this->collection = new FloatCollection([5.2, 6.3]);

        $expected = 6.3;
        $actual = $this->collection[1];
        self::assertSame($expected, $actual);
    }

    public function testAddFloat(): void
    {
        $this->collection[] = 7.2;

        $expected = 7.2;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    /** @psalm-suppress InvalidArgument */
    public function testAddFloatAsString(): void
    {
        $this->collection[] = '7.2';

        $expected = 7.2;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    public function testAddInteger(): void
    {
        $this->collection[] = 7;

        $expected = 7.0;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    /** @psalm-suppress InvalidArgument */
    public function testAddIntegerAsString(): void
    {
        $this->collection[] = '7';

        $expected = 7.0;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    public function testAddZero(): void
    {
        $this->collection[] = 0;

        $expected = 0.0;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    /** @psalm-suppress InvalidArgument */
    public function testAddZeroAsString(): void
    {
        $this->collection[] = '0';

        $expected = 0.0;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    /** @psalm-suppress InvalidArgument */
    public function testAddSomeString(): void
    {
        $this->expectException(TypeError::class);

        $this->collection[] = 'test';
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

    /** @psalm-suppress InvalidArgument */
    public function testAddArray(): void
    {
        $this->expectException(TypeError::class);

        $this->collection[] = [];
    }

    public function testIterator(): void
    {
        $this->collection[] = 4.6;

        foreach ($this->collection as $item) {
            $expected = 4.6;
            $actual = $item;
            self::assertSame($expected, $actual);
        }
    }
}
