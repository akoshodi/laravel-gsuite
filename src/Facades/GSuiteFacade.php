<?php

namespace Akoshodi\GSuite\Facades;

use Illuminate\Support\Facades\Facade;

class GSuiteFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'gsuite';
    }
}
