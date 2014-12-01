<?php

namespace BryanCrowe\Growl\Builder;

class NotifySendBuilder extends BuilderAbstract
{
    /**
     * The program's name.
     *
     * @var string
     */
    const PROGRAM = 'notify-send';

    /**
     * Builds the notify-send command to be executed.
     *
     * @param array $options An array of options to use for building the command.
     *
     * @return string The fully-built command to execute.
     */
    public function build($options)
    {
        $command = self::PROGRAM;

        if (isset($options['title'])) {
            $command .= ' ' . $this->escape($options['title']);
        }
        if (isset($options['message'])) {
            $command .= ' ' . $this->escape($options['message']);
        }
        if (isset($options['sticky']) && $options['sticky'] === true) {
            $command .= ' -t 0';
        }

        return $command;
    }
}
