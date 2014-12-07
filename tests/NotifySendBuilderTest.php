<?php
use BryanCrowe\Growl\Builder\NotifySendBuilder;
use \PHPUnit_Framework_TestCase;

class NotifySendBuilderTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->NotifySendBuilder = new NotifySendBuilder();
    }

    public function tearDown()
    {
        unset($this->NotifySendBuilder);
        parent::tearDown();
    }

    public function testBuild()
    {
        $options = array(
            'title' => 'Hello',
            'message' => 'World',
            'sticky' => true
        );
        $expected = "notify-send 'Hello' 'World' -t 0";
        $result = $this->NotifySendBuilder->build($options);
        $this->assertSame($expected, $result);

        $options = array(
            'title' => 'Hello',
            'message' => 'Welcome'
        );
        $expected = "notify-send 'Hello' 'Welcome'";
        $result = $this->NotifySendBuilder->build($options);
        $this->assertSame($expected, $result);
    }
}
