<?php

namespace BryanCrowe\Growl\Builder;

class TerminalNotifierBuilder extends BuilderAbstract
{
    const PROGRAM = 'terminal-notifier';

    public function build($args)
    {
        $command = self::PROGRAM;

        if (isset($args['title'])) {
                $command .= ' -title ' . $this->quotify($args['title']);
            }
        if (isset($args['subtitle'])) {
            $command .= ' -subtitle ' . $this->quotify($args['subtitle']);
        }
        if (isset($args['message'])) {
            $command .= ' -message ' . $this->quotify($args['message']);
        }

        return $command;
    }
}
