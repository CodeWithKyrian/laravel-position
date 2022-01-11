<?php

namespace Codewithkyrian\LaravelPosition;

use Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
require("Helpers.php");

class LaravelPositionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/position.php', 'position'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/position.php' => config_path('position.php'),
        ], 'position-config');

        Collection::macro('rankBy', function (
            $key,
            ?string $returnKey = null,
            ?bool $showTotal = null,
            ?string $joinText = null
        ) {
            $data = $this->sortByDesc($key)->values();
            $rank = 1;
            $prev = $data->first();
            $skip = false;
            $count = $data->count();

            $result = $data->map(function ($value, $index) use (
                &$rank,
                &$prev,
                &$skip,
                $key,
                $returnKey,
                $showTotal,
                $joinText,
                $count
            ) {
                $returnKey ??= config('position.key');
                $showTotal ??=  config('position.show_total');
                $joinText ??=  config('position.join_text');
                
                if ($index != 0) {
                    if (get_prop($prev, $key) != get_prop($value, $key)) {
                        if ($skip) $rank++;
                        $prev = $value;
                        $rank++;
                        $skip = false;
                    } else {
                        $skip = true;
                    }
                }
                if ($showTotal)
                    $value[$returnKey] = str_ordinal($rank) . ' ' . $joinText . ' ' . $count;
                else
                    $value[$returnKey] = str_ordinal($rank);
                return $value;
            });

            return $result;
        });
    }
}
