<?php

namespace BryanCrowe\Growl\Builder;

class GrowlNotifyBuilder extends BuilderAbstract
{
    /**
     * The program's name.
     *
     * @var string
     */
    const PROGRAM = 'growlnotify';

    /**
     * Builds the growlnotify command to be executed.
     *
     * @param array $args An array of options to use for building the command.
     *
     * @return string The fully-built command to execute.
     */
    public function build($args)
    {
        $command = self::PROGRAM;

        if (PHP_OS === 'Darwin') {
            if (isset($args['title'])) {
                $command .= ' -t ' . $this->quotify($args['title']);
            }
            if (isset($args['message'])) {
                $command .= ' -m ' . $this->quotify($args['message']);
            }
            if (isset($args['sticky']) && $args['sticky'] === true) {
                $command .= ' --sticky';
            }

            return $command;
        }

        if (PHP_OS === 'WINNT') {
            if (isset($args['title'])) {
                $command .= ' /t:' . $this->quotify($args['title']);
            }
            if (isset($args['sticky']) && $args['sticky'] === true) {
                $command .= ' /s:true';
            }
            if (isset($args['message'])) {
                $command .= ' ' . $this->quotify($args['message']);
            }

            return $command;
        }
    }
}
