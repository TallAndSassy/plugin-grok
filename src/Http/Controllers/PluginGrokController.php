<?php


namespace TallAndSassy\PluginGrok\Http\Controllers;

class PluginGrokController extends \TallAndSassy\PageGuide\Http\Controllers\Admin\AdminBaseController
{
    public const viewRef = "grok::admin/dev/grok";
    public static string $title = 'Grok Hub';
    public function getBodyView(string $subLevels) : \Illuminate\View\View
    {
        $route = app('router')->getRoutes()->match(app('request')->create('/grok', 'GET'));
        //          $controllerAtMethod_asString = $route->action['controller'];
        //        $controllerAtMethod_asString = str_replace('getFrontView', 'getBodyView', $controllerAtMethod_asString);
        //        $this->ControllerName = substr($route->action['controller'], 0, strpos($controllerAtMethod_asString, '@'));// trim everything before '@'


        if (isset($route->action['controller'])) {
            $bodyView = \App::call($route->action['controller'], ['subLevels' => $subLevels]);
        } elseif (isset($route->action['uses'])) {
            $bodyView = \App::call($route->action['uses'], ['subLevels' => $subLevels]);
        }
        return $bodyView;
    }
}
