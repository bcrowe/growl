<?php
namespace BryanCrowe;

class Growl
{
    public function __construct() {}

    /**
     * Options:
     *  - title The title
     *  - subtitle The subtitle
     *  - sticky Make it sticky. Defaults to false
     *
     */
    public function growl($message = null, $options = [])
    {
        $args = $this->createCommand();
        if (PHP_OS === 'Darwin') {
        }
        if (PHP_OS === 'Linux') {
        }
        if (PHP_OS === 'WINNT') {
        }
    }

    public function createCommand()
    {
        switch (PHP_OS) {
            case 'Darwin':
                if (exec('which growlnotify')) {
                    return [
                        'type' => 'Darwin-Growl',
                        'pkg' => 'growlnotify',
                        'msg' => '-m',
                        'sticky' => '--sticky'
                    ];
                } else {
                    return [
                        'type' => 'Darwin-Notifier',
                        'pkg' => 'terminal-notifier',
                        'msg' => '-message',
                        'title' => '-title',
                        'subtitle' => '-subtitle'
                    ];
                }
            break;
            case 'Linux':
                if (exec('which growl')) {
                    return [
                        'type' => 'Linux-Growl',
                        'pkg' => 'growl',
                        'msg' => '-m',
                        'title' => '-title',
                        'subtitle' => '-subtitle'
                    ];
                } else {
                    return [
                        'type' => 'Linux-Notify',
                        'pkg' => 'notify-send',
                        'msg' => '',
                        'sticky' => '-t 0'
                    ];
                }
            break;
            case 'WINNT':
                return [
                    'type' => 'Windows',
                    'pkg' => 'growlnotify',
                    'msg' => '',
                    'title' => '/t:',
                    'sticky' => '/s:true'
                ];
            break;
        }
    }
}
