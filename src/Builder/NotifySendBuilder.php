<?php

namespace BryanCrowe\Growl\Builder;

/**
 * This class is a builder for notify-send commands.
 */
class NotifySendBuilder extends BuilderAbstract
{
    /**
     * The command's name.
     *
     * @var string
     */
    protected $command = 'notify-send';

    /**
     * Builds the notify-send command to be executed.
     *
     * @param array $options An array of options to use for building the command.
     * @return string The fully-built command to execute.
     */
    public function build($options)
    {
        $command = $this->command;

        if (isset($options['title'])) {
            $command .= ' ' . $options['title'];
        }
        if (isset($options['message'])) {
            $command .= ' ' . $options['message'];
        }
        if (isset($options['sticky']) && $options['sticky'] === true) {
            $command .= ' -t 0';
        }

        return $command;
    }
}
