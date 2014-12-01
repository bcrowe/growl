<?php

namespace BryanCrowe\Growl;

use BryanCrowe\Growl\Builder\BuilderAbstract;

class Growl
{
    /**
     * The Builder to use for building the command.
     *
     * @var BuilderAbstract
     */
    protected $builder;

    /**
     * An array of options to use for building commands.
     *
     * @var array
     */
    protected $options = array();

    /**
     * Constructor.
     *
     * Accepts a Builder object to be used in building the command.
     *
     * @param BuilderAbstract $builder
     *
     * @return void
     */
    public function __construct(BuilderAbstract $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Executes the built command.
     *
     * @return string
     */
    public function execute()
    {
        $command = $this->builder->build($this->options);

        return exec($command);
    }

    /**
     * Implement the __call magic method to provide an expressive way of setting
     * options for commands.
     *
     * @param string $name The name of the method called.
     * @param array $args An array of the supplied arguments.
     *
     * @return $this
     */
    public function __call($name, $args)
    {
        $this->options[$name] = $args[0];

        return $this;
    }
}
