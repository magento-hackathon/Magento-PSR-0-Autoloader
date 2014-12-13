<?php

namespace MagentoHackathon\Autoloader\Test\Basic;

class CaseTest extends \PHPUnit_Framework_TestCase
{

    public function testGetModel()
    {
        $model = \Mage::getModel('core/url');
        $this->assertTrue(!!$model);
    }
}
