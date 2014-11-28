<?php

namespace BryanCrowe\Growl;

class Growl
{
    protected $builder;

    protected $args = array();

    public function __construct($builder)
    {
        $this->builder = $builder;
    }

    public function execute()
    {
        $command = $this->builder->build($this->args);
        return exec($command);
    }

    public function __call($name, $args)
    {
        $this->args[$name] = $args[0];
        return $this;
    }
}
