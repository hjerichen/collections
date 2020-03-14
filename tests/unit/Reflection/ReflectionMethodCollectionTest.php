<?php

namespace HJerichen\Collections;

use HJerichen\Collections\Reflection\ReflectionMethodCollection;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;

/**
 * @author Heiko Jerichen <heiko@jerichen.de>
 */
class ReflectionMethodCollectionTest extends TestCase
{
    /**
     * @var Collection
     */
    private $collection;
    /**
     * @var ReflectionMethod
     */
    private $reflectionMethod1;
    /**
     * @var ReflectionMethod
     */
    private $reflectionMethod2;

    public function setUp(): void
    {
        $this->reflectionMethod1 = new ReflectionMethod(__CLASS__, 'setUp');
        $this->reflectionMethod2 = new ReflectionMethod(__CLASS__, 'setUp');
        $this->collection = new ReflectionMethodCollection();
    }

    public function testClassImplementsCorrectInterface(): void
    {
        $expected = Collection::class;
        $actual = $this->collection;
        $this->assertInstanceOf($expected, $actual);
    }

    public function testCountForEmpty(): void
    {
        $expected = 0;
        $actual = count($this->collection);
        $this->assertSame($expected, $actual);
    }

    public function testCountForTwo(): void
    {
        $this->collection[] = $this->reflectionMethod1;
        $this->collection[] = $this->reflectionMethod2;

        $expected = 2;
        $actual = count($this->collection);
        $this->assertSame($expected, $actual);
    }

    public function testRetrieveItem(): void
    {
        $this->collection[] = $this->reflectionMethod1;

        $expected = $this->reflectionMethod1;
        $actual = $this->collection[0];
        $this->assertSame($expected, $actual);
    }

    public function testRetrieveItemWithString(): void
    {
        $this->collection['test'] = $this->reflectionMethod1;
        $this->collection['name'] = $this->reflectionMethod2;

        $expected = $this->reflectionMethod2;
        $actual = $this->collection['name'];
        $this->assertSame($expected, $actual);
    }

    public function testAddingOtherTypeThrowException(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $reflectionClass = new ReflectionClass(__CLASS__);
        $this->collection[] = $reflectionClass;
    }

    public function testUnsetItem(): void
    {
        $this->collection['test'] = $this->reflectionMethod1;
        $this->collection['name'] = $this->reflectionMethod2;

        unset($this->collection['name']);

        $expected = $this->reflectionMethod1;
        $actual = $this->collection['test'];
        $this->assertSame($expected, $actual);

        $expected = null;
        $actual = $this->collection['name'];
        $this->assertSame($expected, $actual);
    }

    public function testTraverseCollection(): void
    {
        $this->collection['test'] = $this->reflectionMethod1;
        $this->collection['name'] = $this->reflectionMethod2;

        $iterator = $this->collection->getIterator();
        $iterator->rewind();

        $expected = $this->reflectionMethod1;
        $actual = $iterator->current();
        $this->assertSame($expected, $actual);

        $expected = 'test';
        $actual = $iterator->key();
        $this->assertSame($expected, $actual);

        $iterator->next();

        $expected = $this->reflectionMethod2;
        $actual = $iterator->current();
        $this->assertSame($expected, $actual);

        $expected = 'name';
        $actual = $iterator->key();
        $this->assertSame($expected, $actual);

        $iterator->next();

        $expected = false;
        $actual = $iterator->valid();
        $this->assertSame($expected, $actual);
    }

    public function testIsset(): void
    {
        $this->collection['test'] = $this->reflectionMethod1;
        $this->collection['name'] = $this->reflectionMethod2;

        $expected = true;
        $actual = isset($this->collection['test']);
        $this->assertSame($expected, $actual);

        $expected = false;
        $actual = isset($this->collection['jon']);
        $this->assertSame($expected, $actual);
    }

    public function testPutItemsIntoConstructor(): void
    {
        $reflectionClasses = [
            $this->reflectionMethod1,
            $this->reflectionMethod2
        ];

        $collection = new ReflectionMethodCollection($reflectionClasses);

        $expected = $reflectionClasses[0];
        $actual = $collection[0];
        $this->assertSame($expected, $actual);
    }

    public function testPutWrongItemsIntoConstructor(): void
    {
        $reflectionClasses = [
            new ReflectionMethod(__CLASS__, 'setUp'),
            new ReflectionClass(__CLASS__)
        ];

        $this->expectException(InvalidArgumentException::class);

        new ReflectionMethodCollection($reflectionClasses);
    }
}