<?php

namespace BryanCrowe\Growl\Builder;

interface BuilderInterface
{
    /**
     * Build the command string to be executed.
     *
     * @return string
     */
    public function build($options);

    /**
     * Escapes an argument.
     *
     * @return string
     */
    public function escape($string);
}
