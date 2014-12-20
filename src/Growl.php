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
     * Whether or not to escape the command arguments.
     *
     * @var boolean
     */
    protected $escape = true;

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
        if ($this->escape !== false) {
            $this->options = $this->escape($this->options);
        }
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
    public function setOption($key, $value)
    {
        $this->options[$key] = $value;

        return $this;
    }

    /**
     * Set an entire set of options for a Builder. This is available so a user
     * bulk-set options rather than chaining set() calls.
     *
     * @param array $options The entire set of options.
     *
     * @return $this
     */
    public function setOptions(array $options)
    {
        foreach($options as $key => $value) {
            $this->options[$key] = $value;
        }

        return $this;
    }

    /**
     * Set the escape properties value. Set it to false to disable command
     * arguement escaping.
     *
     * @param boolean $value Pass false to disable escaping.
     *
     * @return $this
     */
    public function setEscape($value)
    {
        $this->escape = $value;

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
        $results = array();
        foreach ($options as $key => $value) {
            $results[$key] = escapeshellarg($value);
        }
        return $results;
    }
}
