<?php

namespace BryanCrowe\Growl\Builder;

use InvalidArgumentException;

abstract class BuilderAbstract implements BuilderInterface
{
    /**
     * The notifier's path.
     *
     * @var string
     */
    protected $path;

    /**
     * Constructor. Offers an opportunity to set a notifier's alias/path.
     *
     * @throws InvalidArgumentException If the argument isn't a string.
     */
    public function __construct($path = null)
    {
        if ($path === null) {
            return;
        }
        if (is_string($path)) {
            $this->path = $path;
            return;
        }

        throw new InvalidArgumentException('This constructor expects a string argument.');
    }

    /**
     * Build the command string to be executed.
     *
     * @param array $options An array of options to use for building the command.
     * @return string
     */
    abstract public function build($options);
}
