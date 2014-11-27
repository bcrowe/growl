<?php

namespace BryanCrowe\Growl\Builder;

class GrowlNotifyBuilder extends BuilderAbstract
{
    const PROGRAM = 'growlnotify';

    public function build($args)
    {
        $command = self::PROGRAM;

        if (PHP_OS === 'Darwin') {

        }

        if (PHP_OS === 'WINNT') {

        }
    }
}
