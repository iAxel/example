<?php

namespace Tests\Traits;

use Illuminate\Foundation\Application;

use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    /**
     * @return Application
     */
    public function createApplication(): Application
    {
        $app = require __DIR__ . '/../../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
