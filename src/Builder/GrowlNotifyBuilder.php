<?php

namespace BryanCrowe\Growl\Builder;

/**
 * This class is a builder for growlnotify commands.
 */
class GrowlNotifyBuilder extends BuilderAbstract
{
    /**
     * The notifier's path.
     *
     * @var string
     */
    protected $path = 'growlnotify';

    /**
     * Builds the growlnotify command to be executed.
     *
     * @param array $options An array of options to use for building the command.
     * @return string The fully-built command to execute.
     */
    public function build($options)
    {
        $command = $this->path;

        if (isset($options['title'])) {
            $command .= " -t {$options['title']}";
        }
        if (isset($options['message'])) {
            $command .= " -m {$options['message']}";
        }
        if (isset($options['appIcon'])) {
            $command .= " -a {$options['appIcon']}";
        }
        if (isset($options['url'])) {
            $command .= " --url {$options['url']}";
        }
        if (isset($options['sticky']) && $options['sticky'] === true) {
            $command .= ' -s';
        }

        return $command;
    }
}
