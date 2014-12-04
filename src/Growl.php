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
     * Set options for Builders with a key/value.
     *
     * @param string $key The key.
     * @param array $value The value of the key.
     *
     * @return $this
     */
    public function set($key, $value)
    {
        $this->options[$key] = $value;

        return $this;
    }
}
