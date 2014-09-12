<?php
use BryanCrowe\Growl;
use \PHPUnit_Framework_TestCase;

class GrowlTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->argSets = [
            'Darwin-Growl' => [
                'type' => 'Darwin-Growl',
                'pkg' => 'growlnotify',
                'msg' => '-m',
                'title' => '',
                'sticky' => '--sticky'
            ],
            'Darwin-Notifier' => [
                'type' => 'Darwin-Notifier',
                'pkg' => 'terminal-notifier',
                'msg' => '-message',
                'title' => '-title',
                'subtitle' => '-subtitle'
            ],
            'Linux-Notify' => [
                'type' => 'Linux-Notify',
                'pkg' => 'notify-send',
                'msg' => '',
                'sticky' => '-t 0'
            ],
            'Windows-Growl' => [
                'type' => 'Windows-Growl',
                'pkg' => 'growlnotify',
                'msg' => '',
                'title' => '/t:',
                'sticky' => '/s:true'
            ]
        ];

        $this->Growl = new Growl();
    }

    public function tearDown()
    {
        unset($this->argSets);
        unset($this->Loader);
        parent::tearDown();
    }

    public function testDarwinGrowl()
    {
        $argSets = $this->argSets;

        $expected = 'growlnotify -m "This is a Darwin growl!"  "Hello Darwin Growl" --sticky';
        $options = ['title' => 'Hello Darwin Growl', 'subtitle' => 'Unsuppored Subtitle', 'sticky' => true];
        $result = $this->Growl->buildCommand('This is a Darwin growl!', $argSets['Darwin-Growl'], $options);
        $this->assertEquals($expected, $result);

        $expected = 'growlnotify -m "This is a Darwin terminal notification with no sticky!"  "Hello Darwin Growl"';
        $options = ['title' => 'Hello Darwin Growl', 'subtitle' => 'Unsuppored Subtitle'];
        $result = $this->Growl->buildCommand('This is a Darwin terminal notification with no sticky!', $argSets['Darwin-Growl'], $options);
        $this->assertEquals($expected, $result);
    }

    public function testTerminalNotifier()
    {
        $argSets = $this->argSets;

        $expected = 'terminal-notifier -message "This is a Darwin terminal notification!" -title "Hello Darwin Terminal" -subtitle "Cool Subtitle"';
        $options = ['title' => 'Hello Darwin Terminal', 'subtitle' => 'Cool Subtitle', 'sticky' => true];
        $result = $this->Growl->buildCommand('This is a Darwin terminal notification!', $argSets['Darwin-Notifier'], $options);
        $this->assertEquals($expected, $result);
    }

    public function testLinuxNotify()
    {
        $argSets = $this->argSets;

        $expected = 'notify-send "Hello Darwin Terminal" "This is a Linux notification!"';
        $options = ['title' => 'Hello Darwin Terminal'];
        $result = $this->Growl->buildCommand('This is a Linux notification!', $argSets['Linux-Notify'], $options);
        $this->assertEquals($expected, $result);

        $expected = 'notify-send "Hello Darwin Terminal" "This is a Linux notification!" -t 0';
        $options = ['title' => 'Hello Darwin Terminal', 'subtitle' => 'Cool Subtitle', 'sticky' => true];
        $result = $this->Growl->buildCommand('This is a Linux notification!', $argSets['Linux-Notify'], $options);
        $this->assertEquals($expected, $result);
    }

    public function testWindowsGrowl()
    {
        $argSets = $this->argSets;
    }
}
