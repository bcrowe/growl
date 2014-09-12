<?php
namespace BryanCrowe;

use RuntimeException;

class Growl
{

    /**
     * Executes a growl/notification command.
     *
     * Options:
     *  - title: The title of the notification.
     *  - subtitle: The subtile of the notification. Only for OSX
     *    terminal-notifiter, and Growl on Linux.
     *  - sticky: Set to any value to trigger the stick flag. Only for Growl on
     *    OSX and Windows, and notify-send on Linux.
     *
     * @param string $message The message you want to display.
     * @param array $options Set values and flags.
     * @return string The command that was executed.
     */
    public function growl($message, $options = [])
    {
        $args = $this->getArguments();
        $command = $this->buildCommand($message, $args, $options);

        exec($command);

        return $command;
    }

    /**
     * Builds the command to be executed based on the available arguments and
     * the options that were set in the options array.
     *
     * @param string $message The notification's message.
     * @param array $args Command arguments available.
     * @param array $options Options chosen/set by the user.
     * @return string The fully-built command to be executed.
     */
    public function buildCommand($message, $args = [], $options = [])
    {
        $command = [$args['pkg']];

        if ($args['type'] === 'Linux-Notify') {
            $options['title'] = $this->quotify($options['title']);
            array_push($command, $options['title']);
        }

        if ($args['type'] !== 'Windows-Growl') {
            if ($message && $args['msg']) {
                $message = $this->quotify($message);
                array_push($command, $args['msg'], $message);
            } else {
                $message = $this->quotify($message);
                array_push($command, $message);
            }
        }

        if (isset($options['title']) && isset($args['title'])) {
            $options['title'] = $this->quotify($options['title']);

            if ($args['type'] === 'Windows-Growl') {
                array_push($command, $args['title'] . $options['title']);
            } else {
                array_push($command, $args['title'], $options['title']);
            }
        }

        if (isset($options['subtitle']) && isset($args['subtitle'])) {
            $options['subtitle'] = $this->quotify($options['subtitle']);
            array_push($command, $args['subtitle'], $options['subtitle']);
        }

        if (isset($options['sticky']) && isset($args['sticky'])) {
            array_push($command, $args['sticky']);
        }

        if ($args['type'] === 'Windows-Growl') {
            $message = $this->quotify($message);
            array_push($command, $message);
        }

        return implode(' ', $command);
    }

    /**
     * Returns an array of arguments to be used in building the growl or
     * notification command, determined by which OS is running and whether or
     * not "growlnotify" is available.
     *
     * @return array
     */
    protected function getArguments()
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
                } elseif (exec('which terminal-notifier')) {
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
                if (exec('which notify-send')) {
                    return [
                        'type' => 'Linux-Notify',
                        'pkg' => 'notify-send',
                        'msg' => '',
                        'sticky' => '-t 0'
                    ];
                }
            break;
            case 'WINNT':
                if (exec('where growlnotify')) {
                    return [
                        'type' => 'Windows-Growl',
                        'pkg' => 'growlnotify',
                        'msg' => '',
                        'title' => '/t:',
                        'sticky' => '/s:true'
                    ];
                }
            break;
        }

        throw new RuntimeException('Could not find any notification packages.');
    }

    /**
     * Wraps strings in double quotations.
     *
     * @return string
     */
    protected function quotify($string)
    {
        return '"' . $string . '"';
    }
}
