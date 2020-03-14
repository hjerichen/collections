<?php

namespace HJerichen\Collections\Reflection;

use HJerichen\Collections\Collection;
use HJerichen\Collections\TestHelpers\NormalObject;
use HJerichen\Collections\TestHelpers\StringObject;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use ReflectionProperty;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 */
class ReflectionPropertyCollectionTest extends TestCase
{
    /**
     * @var ReflectionPropertyCollection
     */
    private $collection;
    /**
     * @var ReflectionProperty
     */
    private $reflectionProperty;

    /**
     *
     */
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
        $this->assertInstanceOf($expected, $actual);
    }

    public function testInitializeWitReflectionProperty(): void
    {
        $this->collection = new ReflectionPropertyCollection([$this->reflectionProperty]);

        $expected = $this->reflectionProperty;
        $actual = $this->collection[0];
        $this->assertSame($expected, $actual);
    }

    public function testAddReflectionProperty(): void
    {
        $this->collection[] = $this->reflectionProperty;

        $expected = $this->reflectionProperty;
        $actual = $this->collection[0];
        $this->assertSame($expected, $actual);
    }

    public function testAddOtherObject(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->collection[] = new NormalObject();
    }

    public function testIterator(): void
    {
        $this->collection[] = $this->reflectionProperty;

        $expected = $this->reflectionProperty;
        $actual = $this->collection->getIterator()->current();
        $this->assertSame($expected, $actual);
    }
}
