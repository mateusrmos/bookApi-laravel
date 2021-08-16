<?php

namespace Tests;

use Faker\Factory;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * 
     * @var Faker\Factory
     */
    protected $faker;

    protected function setUp(): void
    {
        $this->faker = Factory::create();
        parent::setUp();
    }
}
