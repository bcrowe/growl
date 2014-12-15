<?php
use BryanCrowe\Growl\Growl;
use BryanCrowe\Growl\Builder\GrowlNotifyBuilder;
use \PHPUnit_Framework_TestCase;

class GrowlTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->Growl = new Growl(new GrowlNotifyBuilder());
    }

    public function tearDown()
    {
        unset($this->Growl);
        parent::tearDown();
    }

    public function testSet()
    {
        $expected = array(
            'hello' => 'world',
            'title' => 'Hey',
            'message' => 'Whatsup?'
        );
        $result = $this->Growl->set('hello', 'world')
            ->set('title', 'Hey')
            ->set('message', 'Whatsup?');

        $this->assertEquals($expected, PHPUnit_Framework_Assert::readAttribute($result, 'options'));
    }

    public function testEscape()
    {
        $expected = array(
            'hello' => '\'world\''
        );

        $growl = new Growl(new GrowlNotifyBuilder());
        $growlReflection = new ReflectionClass($growl);
        $method = $growlReflection->getMethod('escape');
        $method->setAccessible(true);
     
        $this->assertEquals($expected, $method->invokeArgs($growl, array(array('hello' => 'world'))));
    }
}
