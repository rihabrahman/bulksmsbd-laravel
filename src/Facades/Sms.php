<?php

namespace RihabRahman\BulkSmsBd\Facades;

use Illuminate\Support\Facades\Facade;

class Sms extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'bulksmsbd'; // bound key in the ServiceProvider
    }
}
