<?php
namespace BryanCrowe\Growl\Test;

use BryanCrowe\Growl\Builder\GrowlNotifyBuilder;

class GrowlNotifyBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->GrowlNotifyBuilder = new GrowlNotifyBuilder;
        $this->GrowlNotifyBuilderAliased = new GrowlNotifyBuilder('grwl');
    }

    public function tearDown()
    {
        unset($this->GrowlNotifyBuilder);
        unset($this->GrowlNotifyBuilderAliased);
        parent::tearDown();
    }

    public function testBuild()
    {
        $options = [
            'title' => 'Hello',
            'message' => 'World',
            'image' => 'Mail',
            'url' => 'http://www.example.com',
            'sticky' => true
        ];
        $expected = 'growlnotify -t Hello -m World -a Mail --url' .
                    ' http://www.example.com -s';
        $result = $this->GrowlNotifyBuilder->build($options);
        $this->assertSame($expected, $result);

        $options = [
            'title' => 'Hello',
            'message' => 'World',
            'image' => '/Users/beakman/hello.jpg',
            'sticky' => false
        ];
        $expected = 'growlnotify -t Hello -m World --image /Users/beakman/hello.jpg';
        $result = $this->GrowlNotifyBuilder->build($options);
        $this->assertSame($expected, $result);
    }

    public function testBuildWithAlias()
    {
        $options = [
            'title' => 'Hello',
            'message' => 'World',
            'sticky' => true
        ];
        $expected = 'grwl -t Hello -m World -s';
        $result = $this->GrowlNotifyBuilderAliased->build($options);
        $this->assertSame($expected, $result);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testAliasException()
    {
        $exception = new GrowlNotifyBuilder(['no' => 'arraysplz']);
    }
}
