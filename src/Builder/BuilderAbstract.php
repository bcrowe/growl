<?php

namespace BryanCrowe\Growl\Builder;

abstract class BuilderAbstract implements BuilderInterface
{

    /**
     * Build the command string to be executed.
     *
     * @return string
     */
    abstract public function build($args);


    /**
     * Wraps a string in double quotes.
     *
     * @return string
     */
    public function quotify($text)
    {
        return '"' . $text . '"';
    }
}
