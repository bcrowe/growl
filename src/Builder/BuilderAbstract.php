<?php

namespace BryanCrowe\Growl\Builder;

abstract class BuilderAbstract implements BuilderInterface
{
    /**
     * The command's name.
     *
     * @var string
     */
    protected $command;

    /**
     * Constructor. Offers an opportunity to set a command's alias/path.
     *
     * @throws InvalidArgumentException If the argument isn't a string.
     */
    public function __construct()
    {
        $args = func_get_args();
        if (!empty($args)) {
            if (is_string($args[0])) {
                $this->command = $args[0];
            } else {
                throw new InvalidArgumentException('This constructor expects a string argument.');
            }
        }
    }

    /**
     * Build the command string to be executed.
     *
     * @param array $options An array of options to use for building the command.
     * @return string
     */
    abstract public function build($options);
}
