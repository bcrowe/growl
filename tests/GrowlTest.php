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

    public function testDarwinGrowlNotify()
    {
        $argSets = $this->argSets;

        $expected = 'growlnotify -m "This is a Darwin growl!"  "Hello Darwin Growl" --sticky';
        $options = ['title' => 'Hello Darwin Growl', 'subtitle' => 'Unsuppored Subtitle', 'sticky' => true];
        $result = $this->Growl->buildCommand('This is a Darwin growl!', $options, $argSets['Darwin-Growl']);
        $this->assertEquals($expected, $result);

        $expected = 'growlnotify -m "This is a Darwin terminal notification with no sticky!"  "Hello Darwin Growl"';
        $options = ['title' => 'Hello Darwin Growl', 'subtitle' => 'Unsuppored Subtitle'];
        $result = $this->Growl->buildCommand('This is a Darwin terminal notification with no sticky!', $options, $argSets['Darwin-Growl']);
        $this->assertEquals($expected, $result);
    }

    public function testDarwninTerminalNotifier()
    {
        $argSets = $this->argSets;

        $expected = 'terminal-notifier -message "This is a Darwin terminal notification!" -title "Hello Darwin Terminal" -subtitle "Cool Subtitle"';
        $options = ['title' => 'Hello Darwin Terminal', 'subtitle' => 'Cool Subtitle', 'sticky' => true];
        $result = $this->Growl->buildCommand('This is a Darwin terminal notification!', $options, $argSets['Darwin-Notifier']);
        $this->assertEquals($expected, $result);
    }

    public function testLinuxNotifySend()
    {
        $argSets = $this->argSets;

        $expected = 'notify-send "Hello Darwin Terminal" "This is a Linux notification!"';
        $options = ['title' => 'Hello Darwin Terminal'];
        $result = $this->Growl->buildCommand('This is a Linux notification!', $options, $argSets['Linux-Notify']);
        $this->assertEquals($expected, $result);

        $expected = 'notify-send "Hello Darwin Terminal" "This is a Linux notification!" -t 0';
        $options = ['title' => 'Hello Darwin Terminal', 'subtitle' => 'Cool Subtitle', 'sticky' => true];
        $result = $this->Growl->buildCommand('This is a Linux notification!', $options, $argSets['Linux-Notify']);
        $this->assertEquals($expected, $result);
    }

    public function testWindowsGrowlNotify()
    {
        $argSets = $this->argSets;

        $expected = 'growlnotify /t:"Hello Windows Growl" /s:true "This is a Windows growl!"';
        $options = ['title' => 'Hello Windows Growl', 'sticky' => true];
        $result = $this->Growl->buildCommand('This is a Windows growl!', $options, $argSets['Windows-Growl']);
        $this->assertEquals($expected, $result);
    }
}
