<?php
use BryanCrowe\Growl\Builder\GrowlNotifyWindowsBuilder;
use \PHPUnit_Framework_TestCase;

class GrowlNotifyWindowsBuilderTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->GrowlNotifyWindowsBuilder = new GrowlNotifyWindowsBuilder();
    }

    public function tearDown()
    {
        unset($this->GrowlNotifyWindowsBuilder);
        parent::tearDown();
    }

    public function testBuild()
    {
        $options = array(
            'title' => 'Hello',
            'message' => 'World',
            'sticky' => true
        );
        $expected = 'growlnotify /t:Hello /s:true World';
        $result = $this->GrowlNotifyWindowsBuilder->build($options);
        $this->assertSame($expected, $result);

        $options = array(
            'title' => 'Hello',
            'message' => 'World',
            'sticky' => false
        );
        $expected = 'growlnotify /t:Hello World';
        $result = $this->GrowlNotifyWindowsBuilder->build($options);
        $this->assertSame($expected, $result);
    }
}
