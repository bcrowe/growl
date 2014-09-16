<?php
namespace BryanCrowe\Monolog\Handler;

use BryanCrowe\Growl\Growl;
use BryanCrowe\Monolog\Formatter\GrowlFormatter;
use Monolog\Handler\AbstractProcessingHandler;

class GrowlHandler extends AbstractProcessingHandler
{
    protected function write(array $record)
    {
        $Growl = new \BryanCrowe\Growl\Growl();
        $title = $record['channel'] . ' - ' . $record['level_name'];
        $Growl->growl($record['formatted'], [
            'title' => $title
        ]);
    }

    protected function getDefaultFormatter()
    {
        return new GrowlFormatter();
    }
}
