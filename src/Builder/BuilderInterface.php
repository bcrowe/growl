<?php

namespace BryanCrowe\Growl\Builder;

interface BuilderInterface
{
    /**
     * Build the command string to be executed.
     *
     * @param array $options An array of options to use for building the command.
     *
     * @return string
     */
    public function build($options);
}
