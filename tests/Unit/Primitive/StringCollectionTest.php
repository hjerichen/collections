<?php declare(strict_types=1);

namespace HJerichen\Collections\Test\Unit\Primitive;

use HJerichen\Collections\Collection;
use HJerichen\Collections\Primitive\StringCollection;
use HJerichen\Collections\Test\Helpers\NormalObject;
use HJerichen\Collections\Test\Helpers\StringObject;
use PHPUnit\Framework\TestCase;
use TypeError;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 */
class StringCollectionTest extends TestCase
{
    private StringCollection $collection;

    protected function setUp(): void
    {
        parent::setUp();

        $this->collection = new StringCollection();
    }


    /* TESTS */

    public function testClassImplementsCorrectInterface(): void
    {
        self::assertInstanceOf(Collection::class, $this->collection);
    }

    public function testGetType(): void
    {
        $expected = 'string';
        $actual = $this->collection->getType();
        $this->assertEquals($expected, $actual);
    }

    public function testAddString(): void
    {
        $this->collection[] = 'test';

        $expected = 'test';
        $actual = $this->collection[0];
        self::assertEquals($expected, $actual);
    }

    /** @psalm-suppress InvalidScalarArgument */
    public function testAddInteger(): void
    {
        $this->collection[] = 2;

        $expected = '2';
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    /** @psalm-suppress ImplicitToStringCast */
    public function testAddStringObject(): void
    {
        $this->collection[] = new StringObject('test');

        $expected = 'test';
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    /**
     * @psalm-suppress InvalidArgument
     * @psalm-suppress InvalidCast
     */
    public function testAddNormalObject(): void
    {
        $this->expectException(TypeError::class);

        $this->collection[] = new NormalObject();
    }

    /** @psalm-suppress InvalidScalarArgument */
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

    /**
     * @psalm-suppress InvalidArgument
     * @psalm-suppress InvalidCast
     */
    public function testAddArray(): void
    {
        $this->expectException(TypeError::class);

        $this->collection[] = [];
    }

    public function testGettingIterator(): void
    {
        $this->collection[] = 'test';

        foreach ($this->collection as $item) {
            $expected = 'test';
            $actual = $item;
            self::assertSame($expected, $actual);
        }
    }
}
