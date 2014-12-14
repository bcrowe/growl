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
    public function execute($escape = true)
    {
        $options = $this->options;
        if ($escape === true) {
            $options = $this->escape($options);
        }
        $command = $this->builder->build($options);

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

    /**
     * Escapes the set of option values.
     *
     * @param array A set of key/value options.
     *
     * @return array The sanitized set of key/value options.
     */
    protected function escape($options)
    {
        $results = [];
        foreach ($options as $key => $value) {
            $result[$key] = escapeshellarg($value);
        }
        return $results;
    }
}
