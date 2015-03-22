<?php

namespace BryanCrowe\Growl\Builder;

/**
 * This class is a builder for heysnarl commands.
 */
class SnarlBuilder extends BuilderAbstract
{
    /**
     * The notifier's path.
     *
     * @var string
     */
    protected $path = 'heysnarl';

    /**
     * Builds the heysnarl command to be executed.
     *
     * @param array $options An array of options to use for building the command.
     * @return string The fully-built command to execute.
     */
    public function build($options)
    {
        $command = $this->path;

        return $command;
    }
}
