<?php

namespace BryanCrowe\Growl\Builder;

class GrowlNotifyWindowsBuilder extends BuilderAbstract
{
    /**
     * The command's name.
     *
     * @var string
     */
    protected $command = 'growlnotify';

    /**
     * Builds the growlnotify command to be executed.
     *
     * @param array $options An array of options to use for building the command.
     *
     * @return string The fully-built command to execute.
     */
    public function build($options)
    {
        $command = $this->command;

        if (isset($options['title'])) {
            $command .= ' /t:' . $this->escape($options['title']);
        }
        if (isset($options['sticky']) && $options['sticky'] === true) {
            $command .= ' /s:true';
        }
        if (isset($options['message'])) {
            $command .= ' ' . $this->escape($options['message']);
        }

        return $command;
    }
}
