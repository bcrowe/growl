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
     * An array of options that are considered safe and should not be escaped
     * while escaping is turned on.
     *
     * @var array
     */
    protected $safe = array();

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
     * Sets option names that are considered safe, in order to bypass escaping.
     *
     * @param mixed A string or array of option names assumed to be safe from
     * escaping.
     *
     * @throws InvalidArgumentException If the method argument isn't a string or
     * array.
     *
     * @return $this
     */
    public function setSafe($options)
    {
        if (is_string($options)) {
            $this->safe[] = $options;
            return $this;
        }

        if (is_array($options)) {
            foreach($options as $key => $value) {
                $this->safe[] = $value;
            }
            return $this;
        }

        throw new InvalidArgumentException('This method expects a string or an array argument.');
    }

    /**
     * Escapes the set of option values.
     *
     * @param array A set of key/value options.
     *
     * @return array The sanitized set of key/value options.
     */
    protected function escape(array $options)
    {
        $results = array();
        foreach ($options as $key => $value) {
            if (!in_array($key, $this->safe)) {
                $results[$key] = escapeshellarg($value);
            } else {
                $results[$key] = $value;
            }
        }
        return $results;
    }
}
