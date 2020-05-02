<?php
/**
 * Created by PhpStorm.
 * User: 张伟
 * Date: 2020/5/2
 * Time: 21:50
 */

namespace Tools;

use Illuminate\Support\ServiceProvider;
use Tools\Tools\MarketBox;

class ToolsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('tools.market', function(){
            return new MarketBox();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}