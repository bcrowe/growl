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

    /**
     * Escapes an argument.
     *
     * @param string $string The argument text.
     *
     * @return string
     */
    public function escape($string);
}
