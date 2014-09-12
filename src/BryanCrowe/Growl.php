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
                        'msg' => '-m'
                    ];
                } else {
                    return [
                        'pkg' => 'terminal-notifier',
                        'msg' => '-message'
                    ];
                }
            break;
            case 'Linux':
                if (exec('which growl')) {
                    return [
                        'pkg' => 'growl',
                        'msg' => '-m'
                    ];
                } else {
                    return [
                        'pkg' => 'notify-send',
                        'msg' => ''
                    ];
                }
            break;
            case 'WINNT':
                return [
                    'pkg' => 'growlnotify',
                    'msg' => ''
                ];
            break;
        }
    }
}
