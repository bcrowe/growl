<?php

namespace BryanCrowe\Growl\Builder;

abstract class BuilderAbstract implements BuilderInterface
{

    /**
     * Description.
     *
     * @return
     */
    abstract public function build($args);


    public function quotify($text)
    {
        return '"' . $text . '"';
    }
}
