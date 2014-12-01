<?php
use BryanCrowe\Growl\Growl;
use BryanCrowe\Growl\Builder\GrowlNotifyBuilder;
use \PHPUnit_Framework_TestCase;

class GrowlTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->Growl = new Growl(new GrowlNotifyBuilder());
    }

    public function tearDown()
    {
        unset($this->Growl);
        parent::tearDown();
    }

    public function testGrowl()
    {
        $this->assertTrue(true);
    }
}
