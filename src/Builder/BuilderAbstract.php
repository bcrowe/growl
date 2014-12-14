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
     * @param array $options An array of options to use for building the command.
     *
     * @return string
     */
    abstract public function build($options);
}
