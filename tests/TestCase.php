<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function checkMethodExist($object, $method)
    {
        $this->assertTrue(
            method_exists($object, $method),
            get_class($object) . ' does not have method ' . $method
        );
    }
}
