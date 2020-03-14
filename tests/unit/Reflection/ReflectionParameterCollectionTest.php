<?php

namespace HJerichen\Collections\Reflection;

use HJerichen\Collections\Collection;
use HJerichen\Collections\TestHelpers\NormalObject;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use ReflectionParameter;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 */
class ReflectionParameterCollectionTest extends TestCase
{
    /**
     * @var ReflectionParameterCollection
     */
    private $collection;
    /**
     * @var ReflectionParameter
     */
    private $reflectionParameter;

    /**
     *
     */
    protected function setUp(): void
    {
        parent::setUp();

        $function = static function($test) {};
        $this->reflectionParameter = new ReflectionParameter($function, 'test');
        $this->collection = new ReflectionParameterCollection();
    }


    /* TESTS */

    public function testClassImplementsCorrectInterface(): void
    {
        $expected = Collection::class;
        $actual = $this->collection;
        $this->assertInstanceOf($expected, $actual);
    }

    public function testInitializeWitReflectionParameter(): void
    {

        $this->collection = new ReflectionParameterCollection([$this->reflectionParameter]);

        $expected = $this->reflectionParameter;
        $actual = $this->collection[0];
        $this->assertSame($expected, $actual);
    }

    public function testAddReflectionParameter(): void
    {
        $this->collection[] = $this->reflectionParameter;

        $expected = $this->reflectionParameter;
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
        $this->collection[] = $this->reflectionParameter;

        $expected = $this->reflectionParameter;
        $actual = $this->collection->getIterator()->current();
        $this->assertSame($expected, $actual);
    }
}
