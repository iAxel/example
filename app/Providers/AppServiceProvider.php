<?php

namespace App\Providers;

use InvalidArgumentException;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        $this->registerValidators();
    }

    /**
     * @return void
     */
    private function registerValidators(): void
    {
        Validator::extend('slug', function ($attributes, $value, $parameters) {
            $slug = Str::slug($value);

            $table = $parameters[0] ?? null;

            $ignoreId = $parameters[1] ?? null;

            if ($table === null) {
                throw new InvalidArgumentException('First parameter does not exist.');
            }

            $query = DB::table($table)->where('slug', '=', $slug);

            if ($ignoreId !== null) {
                $query->where('id', '!=', $ignoreId);
            }

            return $query->exists() !== true;
        });
    }
}
