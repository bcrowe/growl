<?php
namespace BryanCrowe;

class Growl
{
    public function __construct() {}

    public function growl($message = null, $options = []) {}

    public function createCommand()
    {
        switch (PHP_OS) {
            case 'Darwin':
                $command = [];
            break;
            case 'Linux':
                $command = [];
            break;
            case 'WINNT':
                $command = [];
            break;

            return $command;
        }
    }
}
