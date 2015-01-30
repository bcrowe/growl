<?php
use BryanCrowe\Growl\Builder\TerminalNotifierBuilder;

class TerminalNotifierBuilderTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->TerminalNotifierBuilder = new TerminalNotifierBuilder();
    }

    public function tearDown()
    {
        unset($this->TerminalNotifierBuilder);
        parent::tearDown();
    }

    public function testBuild()
    {
        $options = array(
            'title' => 'Hello',
            'subtitle' => 'World',
            'message' => 'Welcome',
            'appIcon' => 'Mail',
            'contentImage' => 'http://www.example.com/hello.jpg',
            'open' => 'http://www.example.com'
        );
        $expected = 'terminal-notifier -title Hello -subtitle World -message Welcome' .
                    ' -appIcon Mail -contentImage http://www.example.com/hello.jpg' .
                    ' -open http://www.example.com';
        $result = $this->TerminalNotifierBuilder->build($options);
        $this->assertSame($expected, $result);

        $options = array(
            'title' => 'Hello',
            'message' => 'Welcome'
        );
        $expected = 'terminal-notifier -title Hello -message Welcome';
        $result = $this->TerminalNotifierBuilder->build($options);
        $this->assertSame($expected, $result);
    }
}
