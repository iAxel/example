<?php

namespace Tests;

use Tests\Traits\CreatesApplication;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    /**
     * @var bool
     */
    protected bool $seed = true;
}
