<?php

namespace BryanCrowe\Growl\Builder;

class NotifySendBuilder extends BuilderAbstract
{
    const PROGRAM = 'notify-send';

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
