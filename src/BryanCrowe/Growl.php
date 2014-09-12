<?php
namespace BryanCrowe;

class Growl
{
    public function __construct() {}

    public function growl($message = null, $options = []) {}

    public function createCommand()
    {
        switch (PHP_OS) {
            case 'Darwin':
                if (exec('which growlnotify')) {
                    return [
                        'pkg' => 'growlnotify',
                        'msg' => '-m',
                        'sticky' => '--sticky'
                    ];
                } else {
                    return [
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
                        'pkg' => 'growl',
                        'msg' => '-m',
                        'title' => '-title',
                        'subtitle' => '-subtitle'
                    ];
                } else {
                    return [
                        'pkg' => 'notify-send',
                        'msg' => '',
                        'sticky' => '-t 0'
                    ];
                }
            break;
            case 'WINNT':
                return [
                    'pkg' => 'growlnotify',
                    'msg' => '',
                    'title' => '/t:',
                    'sticky' => '/s:true'
                ];
            break;
        }
    }
}
