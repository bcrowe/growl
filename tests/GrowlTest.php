<?php
use BryanCrowe\Growl;
use \PHPUnit_Framework_TestCase;

class GrowlTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->Growl = new Growl();
    }

    public function tearDown()
    {

    }

    public function testGrowl()
    {
        $this->assertTrue(true);
    }
}
