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
            'Linux-Growl' => [
                'type' => 'Linux-Growl',
                'pkg' => 'growl',
                'msg' => '-m',
                'title' => '-title',
                'subtitle' => '-subtitle'
            ],
            'Linux-Notify' => [
                'type' => 'Linux-Notify',
                'pkg' => 'notify-send',
                'msg' => '',
                'sticky' => '-t 0'
            ],
            'Windows' => [
                'type' => 'Windows',
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

        $expected = 'growlnotify -m "This is a message"  "LOL OMG" --sticky';
        $options = ['title' => 'LOL OMG', 'subtitle' => 'Sub-guy', 'sticky' => true];
        $result = $this->Growl->buildCommand('This is a message', $argSets['Darwin-Growl'], $options);
        $this->assertEquals($expected, $result);

        $expected = 'growlnotify -m "This is a message"  "LOL OMG"';
        $options = ['title' => 'LOL OMG', 'subtitle' => 'Sub-guy'];
        $result = $this->Growl->buildCommand('This is a message', $argSets['Darwin-Growl'], $options);
        $this->assertEquals($expected, $result);
    }

    public function testTerminalNotifier()
    {
        $argSets = $this->argSets;

        $expected = 'terminal-notifier -message "This is a message" -title "LOL OMG" -subtitle "Sub-guy"';
        $options = ['title' => 'LOL OMG', 'subtitle' => 'Sub-guy', 'sticky' => true];
        $result = $this->Growl->buildCommand('This is a message', $argSets['Darwin-Notifier'], $options);
        $this->assertEquals($expected, $result);
    }
}
