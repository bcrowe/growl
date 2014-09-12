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
                        'pkg' => 'growlnotify'
                    ];
                } else {
                    $command = [
                        'pkg' => 'terminal-notifier'
                    ];
                }
            break;
            case 'Linux':
                if (exec('which growl')) {
                    $command = [
                        'pkg' => 'growl'
                    ];
                } else {
                    $command = [
                        'pkg' => 'notify-send'
                    ];
                }
            break;
            case 'WINNT':
                $command = [
                    'pkg' => 'growlnotify'
                ];
            break;

            return $command;
        }
    }
}
