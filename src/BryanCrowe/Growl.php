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
        $command = [$args['pkg']];

        if ($message && $args['msg']) {
            array_push($command, $args['msg'], '"' . $message . '"');
        } else {
            array_push($command, '"' . $message. '"');
        }

        if (isset($options['title'])) {
            array_push($command, $args['title'], '"' . $options['title'] . '"');
        }

        if (isset($options['subtitle']) && isset($args['subtitle'])) {
            array_push($command, $args['subtitle'], '"' . $options['subtitle'] . '"');
        }

        if (isset($options['sticky']) && isset($args['sticky'])) {
            array_push($command, $args['sticky']);
        }

        $command = implode(' ', $command);
        exec($command);
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
                        'title' => '',
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
