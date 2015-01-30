<?php
use BryanCrowe\Growl\Builder\GrowlNotifyBuilder;

class GrowlNotifyBuilderTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->GrowlNotifyBuilder = new GrowlNotifyBuilder();
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
        $options = array(
            'title' => 'Hello',
            'message' => 'World',
            'appIcon' => 'Mail',
            'url' => 'http://www.example.com',
            'sticky' => true
        );
        $expected = 'growlnotify -t Hello -m World -a Mail --url' .
                    ' http://www.example.com -s';
        $result = $this->GrowlNotifyBuilder->build($options);
        $this->assertSame($expected, $result);

        $options = array(
            'title' => 'Hello',
            'message' => 'World',
            'sticky' => false
        );
        $expected = 'growlnotify -t Hello -m World';
        $result = $this->GrowlNotifyBuilder->build($options);
        $this->assertSame($expected, $result);
    }

    public function testBuildWithAlias()
    {
        $options = array(
            'title' => 'Hello',
            'message' => 'World',
            'sticky' => true
        );
        $expected = 'grwl -t Hello -m World -s';
        $result = $this->GrowlNotifyBuilderAliased->build($options);
        $this->assertSame($expected, $result);
    }
}
