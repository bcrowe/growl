<?php
use BryanCrowe\Growl\Growl;
use BryanCrowe\Growl\Builder\GrowlNotifyBuilder;

class GrowlTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->Growl = new Growl(new GrowlNotifyBuilder);
    }

    public function tearDown()
    {
        unset($this->Growl);
        parent::tearDown();
    }

    public function testBuildCommand()
    {
        $expected = 'growlnotify -t \'Hello\' -m World';
        $result = $this->Growl
                    ->setOptions([
                        'title' => 'Hello',
                        'message' => 'World'
                    ])
                    ->setSafe('message')
                    ->buildCommand();

        $this->assertSame($expected, (string) $result);
    }

    public function testSet()
    {
        $expected = [
            'hello' => 'world',
            'title' => 'Hey',
            'message' => 'Whatsup?'
        ];

        $result = $this->Growl->setOption('hello', 'world')
            ->setOption('title', 'Hey')
            ->setOption('message', 'Whatsup?');
        $this->assertEquals($expected, PHPUnit_Framework_Assert::readAttribute($result, 'options'));

        $result = $this->Growl->setOptions([
            'hello' => 'world',
            'title' => 'Hey',
            'message' => 'Whatsup?'
        ]);
        $this->assertEquals($expected, PHPUnit_Framework_Assert::readAttribute($result, 'options'));
    }

    public function testEscape()
    {
        $expected = [
            'hello' => '\'world\''
        ];

        $growl = new Growl(new GrowlNotifyBuilder);
        $growlReflection = new ReflectionClass($growl);
        $method = $growlReflection->getMethod('escape');
        $method->setAccessible(true);

        $this->assertEquals($expected, $method->invokeArgs($growl, [['hello' => 'world']]));

        $expected = [
            'hello' => '\'world\'',
            'something' => 'else'
        ];

        $growl = new Growl(new GrowlNotifyBuilder);
        $growl->setSafe('something');
        $growlReflection = new ReflectionClass($growl);
        $method = $growlReflection->getMethod('escape');
        $method->setAccessible(true);

        $this->assertEquals($expected, $method->invokeArgs($growl, [['hello' => 'world', 'something' => 'else']]));
    }

    public function testSetEscape()
    {
        $growl = $this->Growl->setEscape(false);
        $this->assertFalse(PHPUnit_Framework_Assert::readAttribute($growl, 'escape'));
    }

    public function testSetSafe()
    {
        $expected = ['hello'];
        $growl = $this->Growl->setSafe('hello');
        $this->assertEquals($expected, PHPUnit_Framework_Assert::readAttribute($growl, 'safe'));

        $expected = ['hello', 'world', 'again'];
        $growl->setSafe(['world', 'again']);
        $this->assertEquals($expected, PHPUnit_Framework_Assert::readAttribute($growl, 'safe'));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetSafeException()
    {
        $growl = $this->Growl->setSafe(true);
    }

    public function testNoArgCtor()
    {
        $growl = new Growl;
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGrowlCtorException()
    {
        $derp = new Growl([]);
    }
}
