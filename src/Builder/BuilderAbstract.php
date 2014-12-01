<?php

namespace BryanCrowe\Growl\Builder;

abstract class BuilderAbstract implements BuilderInterface
{

    /**
     * The commands's name.
     *
     * @var string
     */
    protected $command;

    /**
     * Build the command string to be executed.
     *
     * @return string
     */
    abstract public function build($options);

    /**
     * Escapes an argument.
     *
     * @param string $string The argument text.
     *
     * @return string
     */
    public function escape($string)
    {
        return escapeshellarg($string);
    }
}
