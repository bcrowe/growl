<?php

namespace BryanCrowe\Growl;

use BryanCrowe\Growl\Builder\BuilderAbstract;
use BryanCrowe\Growl\Builder\GrowlNotifyBuilder;
use BryanCrowe\Growl\Builder\GrowlNotifyWindowsBuilder;
use BryanCrowe\Growl\Builder\NotifySendBuilder;
use BryanCrowe\Growl\Builder\TerminalNotifierBuilder;
use \InvalidArgumentException;

/**
 * This class accepts a Builder in its constructor to be used for building the
 * growl/notification command. It contains various methods to set command
 * options, toggling escaping, whitelisting fields, and finally executing the
 * command.
 */
class Growl
{
    /**
     * The Builder to use for building the command.
     *
     * @var BuilderAbstract
     */
    protected $builder = null;

    /**
     * An array of options to use for building commands.
     *
     * @var array
     */
    protected $options = [];

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
    protected $safe = [];

    /**
     * Constructor.
     *
     * Accepts a Builder object to be used in building the command.
     *
     * @param $builder
     * @return void
     * @throws InvalidArgumentException If not null or a BuilderAbstract
     * instance.
     */
    public function __construct($builder = null)
    {
        if ($builder === null) {
            $this->builder = $this->selectBuilder();
            return;
        }
        if ($builder instanceof BuilderAbstract) {
            $this->builder = $builder;
            return;
        }

        throw new InvalidArgumentException(
            'This constructor expects null or a BuilderAbstract instance.'
        );
    }

    /**
     * Executes the command on your machine.
     *
     * @codeCoverageIgnore
     * @return void
     */
    public function execute()
    {
        if ($this->escape !== false) {
            $this->options = $this->escape($this->options);
        }
        if ($this->builder !== null) {
            $command = $this->builder->build($this->options);
            exec($command);
        }
    }

    /**
     * Builds the command.
     *
     * @return string
     */
    public function buildCommand()
    {
        if ($this->escape !== false) {
            $this->options = $this->escape($this->options);
        }
        if ($this->builder !== null) {
            $command = $this->builder->build($this->options);
            return $command;
        }

        return '';
    }

    /**
     * Set options for Builders with a key/value.
     *
     * @param string $key The key.
     * @param array $value The value of the key.
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
     * argument escaping.
     *
     * @param boolean $value Pass false to disable escaping.
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
     * @throws InvalidArgumentException If the method argument isn't a string or
     * array.
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

        throw new InvalidArgumentException(
            'This method expects a string or an array argument.'
        );
    }

    /**
     * Escapes the set of option values.
     *
     * @param array A set of key/value options.
     * @return array The sanitized set of key/value options.
     */
    protected function escape(array $options)
    {
        $results = [];
        foreach ($options as $key => $value) {
            if (!in_array($key, $this->safe)) {
                $results[$key] = escapeshellarg($value);
            } else {
                $results[$key] = $value;
            }
        }

        return $results;
    }

    /**
     * Chooses a Builder to use depending on the operating system and which
     * program is installed.
     *
     * @codeCoverageIgnore
     * @return BuilderAbstract A suitable Builder that was found on the system.
     */
    protected function selectBuilder()
    {
        if (PHP_OS === 'Darwin') {
            if (exec('which growlnotify')) {
                return new GrowlNotifyBuilder;
            }
            if (exec('which terminal-notifier')) {
                return new TerminalNotifierBuilder;
            }
        }
        if (PHP_OS === 'Linux') {
            if (exec('which notify-send')) {
                return new NotifySendBuilder;
            }
        }
        if (PHP_OS === 'WINNT') {
            if (exec('where growlnotify')) {
                return new GrowlNotifyWindowsBuilder;
            }
        }
    }
}
