<?php

namespace TallAndSassy\PluginGrok;

use Illuminate\Support\Facades\Facade;

/**
 * @see \TallAndSassy\PluginGrok\PluginGrok
 */
class PluginGrokFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'plugin-grok';
    }
}
