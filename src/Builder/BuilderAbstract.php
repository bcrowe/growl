<?php

namespace BryanCrowe\Growl\Builder;

abstract class BuilderAbstract implements BuilderInterface
{

    /**
     * Description.
     *
     * @return
     */
    public function build();

    public function quotify($text)
    {
        return '"' . $text . '"';
    }
}
