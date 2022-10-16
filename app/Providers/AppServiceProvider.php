<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Collection::macro('sortByDate', function (string $column = 'created_at', bool $descending = true) {

            return $this->sortBy(function ($datum) use ($column) {
                return strtotime(((object)$datum)->$column);
                }, SORT_REGULAR, $descending);
        });
    }

}
