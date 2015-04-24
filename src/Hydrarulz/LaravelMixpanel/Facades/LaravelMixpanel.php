<?php namespace Hydrarulz\LaravelMixpanel\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelMixpanel extends Facade {
    protected static function getFacadeAccessor() { return 'mixpanel'; }
}