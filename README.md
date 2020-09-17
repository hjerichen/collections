[![Build Status](https://travis-ci.org/hjerichen/collections.svg?branch=master)](https://travis-ci.org/hjerichen/collections)
[![Coverage Status](https://coveralls.io/repos/github/hjerichen/collections/badge.svg?branch=master)](https://coveralls.io/github/hjerichen/collections?branch=master)

# Collections

I like the fact that PHP is going the way to type safety, but unfortunately we haven't reached the goal yet.
The type safety still has some gaps. One of the most annoying gap is (at least for me) that you cannot specify types for array elements.
I don't like it at all to have to specify just "array" as return type.

To avoid this I have created a small set of collections.

#### Primitive Collections
With a primitive collection you can specify the return type like "IntegerCollection" and not just "array".
You should be careful though, because in high performance applications this might not be a suitable way.

#### Object Collections
There is also an easy way to create a collection for certain classes:

```php
<?php

use HJerichen\Collections\ObjectCollection;

class SomeClassCollection extends ObjectCollection
{
    /**
     * @param $elements SomeClass[]
     */
    public function __construct(array $elements = [])
    {
        parent::__construct(SomeClass::class, $elements);
    }

    /**
     * This Method is for static code analysis (Code Completion).
     * @return Traversable | SomeClass[]
     */
    public function getIterator(): Traversable
    {
        return parent::getIterator();
    }

    /**
     * This Method is for static code analysis (Code Completion).
     */
    public function offsetGet($offset): ?SomeClass
    {
        return parent::offsetGet($offset);
    }
}
```

Already existing collections for build-in classes are:  
- ReflectionClassCollection  
- ReflectionMethodCollection  
- ReflectionParameterCollection  
- ReflectionPropertyCollection

#### Mixed Collections
The MixedCollection is basically like "array", but you are telling the reader that in fact it is an array with mixed types.  
Just like PHP 8.0 is introducing the type "mixed".

### License and authors
This project is free and under the MIT Licence. Responsible for this project is Heiko Jerichen (heiko@jerichen.de).