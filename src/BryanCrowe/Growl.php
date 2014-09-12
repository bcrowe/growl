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
                    $command = [
                        'pkg' => 'growlnotify',
                        'msg' => '-m'
                    ];
                } else {
                    $command = [
                        'pkg' => 'terminal-notifier',
                        'msg' => '-message'
                    ];
                }
            break;
            case 'Linux':
                if (exec('which growl')) {
                    $command = [
                        'pkg' => 'growl',
                        'msg' => '-m'
                    ];
                } else {
                    $command = [
                        'pkg' => 'notify-send',
                        'msg' => ''
                    ];
                }
            break;
            case 'WINNT':
                $command = [
                    'pkg' => 'growlnotify',
                    'msg' => ''
                ];
            break;

            return $command;
        }
    }
}
