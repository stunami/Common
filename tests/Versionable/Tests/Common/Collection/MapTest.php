<?php
namespace Versionable\Tests\Common\Collection;

use Versionable\Common\Collection\Map;
use Versionable\Common\Collection\Set;

/**
 * Test class for Map.
 * Generated by PHPUnit on 2011-04-29 at 21:38:31.
 */
class MapTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Map
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Map;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }
    
    public function testClear()
    {
        $this->object->put('one', new \stdClass());
        $this->object->put('two', new \stdClass());
        
        $this->object->clear();
        
        $this->assertEquals(array(), $this->readAttribute($this->object, 'elements'));
        
    }

    public function testContainsKeyTrue()
    {
        $key = 'one';
        $this->object->put($key, new \stdClass()); 

        $this->assertTrue($this->object->containsKey($key));
    }
    
    public function testContainsKeyFalse()
    {
        $key = 'one';
        $this->object->put($key, new \stdClass()); 

        $this->assertFalse($this->object->containsKey('two'));
    }

    public function testContainsValueTrue()
    {
        $object = new \stdClass();
        $this->object->put('one', $object); 

        $this->assertTrue($this->object->containsValue($object));
    }
    
    public function testContainsValueFalse()
    {
        $object = new \stdClass();
        $this->object->put('one', $object); 
        
        $object2 = new \stdClass();

        $this->assertFalse($this->object->containsValue($object2));
    }    

    public function testEntrySet()
    {
        $set = new Set(array_values($this->readAttribute($this->object, 'elements')));
        $this->assertEquals($set, $this->object->entrySet());
    }

    public function testEqualsTrue()
    {
        $this->object->put('one', new \stdClass());
        
        $map = clone $this->object;
        
        $this->assertTrue($this->object->equals($map));
        
    }
    
    public function testEqualsFalse()
    {
        $this->object->put('one', new \stdClass());
        
        $map = new Map();
        
        $this->assertFalse($this->object->equals($map));
        
    }

    public function testGet()
    {
        $value = new \stdClass();
        $this->object->put('one', $value);
        
        $this->assertEquals($value, $this->object->get('one'));
    }
    
    public function testGetNull()
    {
        $value = new \stdClass();
        $this->object->put('one', $value);
        
        $this->assertNull($this->object->get('two'));
    }

    public function testHashCode()
    {
        $hash = sha1('Versionable\Common\Collection\Map' . serialize($this->readAttribute($this->object, 'elements')));
        
        $this->assertEquals($hash, $this->object->hashCode());
    }


    public function testIsEmpty()
    {
      $elements = $this->readAttribute($this->object, 'elements');
      $this->assertEquals(empty($elements), $this->object->isEmpty());
      $this->object->put('one', new \stdClass());
      $elements = $this->readAttribute($this->object, 'elements');
      $this->assertEquals(empty($elements), $this->object->isEmpty());
    }

    public function testIsValid()
    {
      $this->assertTrue($this->object->isValid(new \stdClass()));
    }

    public function testKeySet()
    {
        $keys = $this->object->keySet();
        
        $expected = new Set(array_keys($this->readAttribute($this->object, 'elements')));
        
        $this->assertEquals($expected, $keys);
    }

    public function testPut()
    {
        $key = 'one';
        $value = new \stdClass();
        
        $this->object->put($key, $value);
        
        $actual = $this->readAttribute($this->object, 'elements');
        
        $this->assertEquals(array($key => $value), $actual);
    }

    public function testPutAll()
    {
        $elements = array('one' => new \stdClass(), 'two' => new \stdClass());
        $map = new Map();
        $map->put(key($elements), current($elements));
        next($elements);
        $map->put(key($elements), current($elements));
        
        $this->object->putAll($map);
        
        $actual = $this->readAttribute($this->object, 'elements');
       
        $this->assertEquals($elements, $actual);
    }

    public function testRemove()
    {
        $key = 'one';
        $value = new \stdClass();
        
        $this->object->put($key, $value);
        
        $actual = $this->readAttribute($this->object, 'elements');
        
        $this->assertEquals(array($key => $value), $actual);
        
        $this->object->remove($key);
        
        $actual = $this->readAttribute($this->object, 'elements');
        
        $this->assertEmpty($actual);
    }

    public function testCount()
    {
        $this->object->put('one', new \stdClass());
        $this->object->put('two', new \stdClass());
        $this->object->put('three', new \stdClass());
        $this->object->put('four', new \stdClass());
        $this->object->put('five', new \stdClass());
        
        $this->assertEquals(5, $this->object->count());
    }

    /**
     * @todo Implement testToArray().
     */
    public function testToArray()
    {
        $this->object->put('one', new \stdClass());
        $this->object->put('two', new \stdClass());
        $this->assertEquals($this->readAttribute($this->object, 'elements'), $this->object->toArray());
    }

    /**
     * @todo Implement testValues().
     */
    public function testValues()
    {
        $this->object->put('one', new \stdClass());
        $this->object->put('two', new \stdClass());
        $this->assertEquals(array_values($this->readAttribute($this->object, 'elements')), $this->object->values());
    }

    public function testGetIterator()
    {
      $this->assertInstanceOf('\ArrayIterator', $this->object->getIterator());
    }

    public function testNotValidObject()
    {
      $this->assertFalse($this->object->isValid('test'));
    }

    public function testDoCheckValidException()
    {
      $this->setExpectedException('\InvalidArgumentException');

      $method = new \ReflectionMethod(
        $this->object, 'doCheckValid'
      );

      $method->setAccessible(true);

      $method->invoke($this->object, 'test');
    }
}
