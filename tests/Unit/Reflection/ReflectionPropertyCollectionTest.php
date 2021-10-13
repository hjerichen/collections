<?php declare(strict_types=1);

namespace HJerichen\Collections\Test\Unit\Reflection;

use HJerichen\Collections\Collection;
use HJerichen\Collections\Reflection\ReflectionPropertyCollection;
use HJerichen\Collections\Test\Helpers\NormalObject;
use HJerichen\Collections\Test\Helpers\StringObject;
use PHPUnit\Framework\TestCase;
use ReflectionProperty;
use TypeError;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 */
class ReflectionPropertyCollectionTest extends TestCase
{
    private ReflectionPropertyCollection $collection;
    private ReflectionProperty $reflectionProperty;

    protected function setUp(): void
    {
        parent::setUp();

        $this->reflectionProperty = new ReflectionProperty(StringObject::class, 'text');
        $this->collection = new ReflectionPropertyCollection();
    }


    /* TESTS */

    public function testClassImplementsCorrectInterface(): void
    {
        $expected = Collection::class;
        $actual = $this->collection;
        self::assertInstanceOf($expected, $actual);
    }

    public function testInitializeWitReflectionProperty(): void
    {
        $this->collection = new ReflectionPropertyCollection([$this->reflectionProperty]);

        $expected = $this->reflectionProperty;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    public function testAddReflectionProperty(): void
    {
        $this->collection[] = $this->reflectionProperty;

        $expected = $this->reflectionProperty;
        $actual = $this->collection[0];
        self::assertSame($expected, $actual);
    }

    public function testAddOtherObject(): void
    {
        $this->expectException(TypeError::class);

        /** @psalm-suppress InvalidArgument */
        $this->collection[] = new NormalObject();
    }

    public function testIterator(): void
    {
        $this->collection[] = $this->reflectionProperty;

        foreach ($this->collection as $item) {
            $expected = $this->reflectionProperty;
            $actual = $item;
            self::assertSame($expected, $actual);
        }
    }
}
