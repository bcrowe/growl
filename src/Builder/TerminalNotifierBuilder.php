<?php

namespace BryanCrowe\Growl\Builder;

class TerminalNotifierBuilder extends BuilderAbstract
{
    /**
     * The program's name.
     *
     * @var string
     */
    const PROGRAM = 'terminal-notifier';

    /**
     * Builds the terminal-notifier command to be executed.
     *
     * @param array $args An array of options to use for building the command.
     *
     * @return string The fully-built command to execute.
     */
    public function build($args)
    {
        $command = self::PROGRAM;

        if (isset($args['title'])) {
            $command .= ' -title ' . $this->escape($args['title']);
        }
        if (isset($args['subtitle'])) {
            $command .= ' -subtitle ' . $this->escape($args['subtitle']);
        }
        if (isset($args['message'])) {
            $command .= ' -message ' . $this->escape($args['message']);
        }

        return $command;
    }
}
