<?php

namespace BryanCrowe\Growl\Builder;

/**
 * This class is a builder for terminal-notifier commands.
 */
class TerminalNotifierBuilder extends BuilderAbstract
{
    /**
     * The notifier's path.
     *
     * @var string
     */
    protected $path = 'terminal-notifier';

    /**
     * Builds the terminal-notifier command to be executed.
     *
     * @param array $options An array of options to use for building the command.
     * @return string The fully-built command to execute.
     */
    public function build($options)
    {
        $command = $this->path;

        if (isset($options['title'])) {
            $command .= " -title {$options['title']}";
        }
        if (isset($options['subtitle'])) {
            $command .= " -subtitle {$options['subtitle']}";
        }
        if (isset($options['message'])) {
            $command .= " -message {$options['message']}";
        }
        if (isset($options['image'])) {
            $command .= " -appIcon {$options['image']}";
        }
        if (isset($options['contentImage'])) {
            $command .= " -contentImage {$options['contentImage']}";
        }
        if (isset($options['url'])) {
            $command .= " -open {$options['url']}";
        }

        return $command;
    }
}
