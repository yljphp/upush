<?php

/*
 * This file is part of the hedeqiang/umeng.
 *
 * (c) hedeqiang <laravel_code@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Yljphp\UPush;

class PushServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    public function boot()
    {
        $this->publishes([
            __DIR__.'/Config/upush.php' => config_path('upush.php'),
        ], 'push');
    }

    public function register()
    {
        $this->app->singleton(Android::class, function () {
            return new Android(config('upush'));
        });
        $this->app->singleton(IOS::class, function () {
            return new IOS(config('upush'));
        });

        $this->app->alias(Android::class, 'upush.android');
        $this->app->alias(IOS::class, 'upush.ios');
    }

    public function provides(): array
    {
        return ['upush.android', 'upush.ios'];
    }
}
