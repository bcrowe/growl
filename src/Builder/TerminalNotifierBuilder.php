<?php

namespace BryanCrowe\Growl\Builder;

class TerminalNotifierBuilder extends BuilderAbstract
{
    /**
     * The command's name.
     *
     * @var string
     */
    protected $command = 'terminal-notifier';

    /**
     * Builds the terminal-notifier command to be executed.
     *
     * @param array $options An array of options to use for building the command.
     *
     * @return string The fully-built command to execute.
     */
    public function build($options)
    {
        $command = $this->command;

        if (isset($options['title'])) {
            $command .= ' -title ' . $this->escape($options['title']);
        }
        if (isset($options['subtitle'])) {
            $command .= ' -subtitle ' . $this->escape($options['subtitle']);
        }
        if (isset($options['message'])) {
            $command .= ' -message ' . $this->escape($options['message']);
        }

        return $command;
    }
}
