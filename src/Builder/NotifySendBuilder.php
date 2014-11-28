<?php

namespace BryanCrowe\Growl\Builder;

class NotifySendBuilder extends BuilderAbstract
{
    const PROGRAM = 'notify-send';

    /**
     * Builds the notify-send command to be executed.
     *
     * @param array $args An array of options to use for building the command.
     *
     * @return string The fully-built command to execute.
     */
    public function build($args)
    {
        $command = self::PROGRAM;

        if (isset($args['title'])) {
            $command .= ' ' . $this->quotify($args['title']);
        }
        if (isset($args['message'])) {
            $command .= ' ' . $this->quotify($args['message']);
        }
        if (isset($args['sticky']) && $args['sticky'] === true) {
            $command .= ' -t 0';
        }

        return $command;
    }
}
