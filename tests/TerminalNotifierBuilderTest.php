<?php
namespace BryanCrowe\Growl\Test;

use BryanCrowe\Growl\Builder\TerminalNotifierBuilder;

class TerminalNotifierBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->TerminalNotifierBuilder = new TerminalNotifierBuilder;
    }

    public function tearDown()
    {
        unset($this->TerminalNotifierBuilder);
        parent::tearDown();
    }

    public function testBuild()
    {
        $options = [
            'title' => 'Hello',
            'subtitle' => 'World',
            'message' => 'Welcome',
            'image' => 'http://www.example.com/example.jpg',
            'contentImage' => 'http://www.example.com/hello.jpg',
            'url' => 'http://www.example.com'
        ];
        $expected = 'terminal-notifier -title Hello -subtitle World -message Welcome' .
                    ' -appIcon http://www.example.com/example.jpg' .
                    ' -contentImage http://www.example.com/hello.jpg' .
                    ' -open http://www.example.com';
        $result = $this->TerminalNotifierBuilder->build($options);
        $this->assertSame($expected, $result);

        $options = [
            'title' => 'Hello',
            'message' => 'Welcome'
        ];
        $expected = 'terminal-notifier -title Hello -message Welcome';
        $result = $this->TerminalNotifierBuilder->build($options);
        $this->assertSame($expected, $result);
    }
}
