<?php

namespace TallAndSassy\PluginGrok;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use TallAndSassy\PluginGrok\Commands\PluginGrokCommand;
use TallAndSassy\PluginGrok\Http\Controllers\PluginGrokController;

class PluginGrokServiceProvider extends ServiceProvider
{
    public static string $blade_prefix = "tassy"; #tassy is a template term
    public static string $language_prefix = "Tassit"; #languageprefix is a template term

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                    __DIR__ . '/../config/plugin-grok.php' => config_path('plugin-grok.php'),
                ],
                'config'
            );

            $this->publishes(
                [
                    __DIR__ . '/../resources/views' => base_path('resources/views/vendor/plugin-grok'),
                ],
                'views'
            );

            $migrationFileName = 'create_plugin_grok_table.php';
            if (! $this->migrationFileExists($migrationFileName)) {
                $this->publishes(
                    [
                        __DIR__ . "/../database/migrations/{$migrationFileName}.stub" => database_path(
                            'migrations/' . date('Y_m_d_His', time()) . '_' . $migrationFileName
                        ),
                    ],
                    'migrations'
                );
            }

            $this->publishes([
                 __DIR__.'/../resources/public' => public_path('tallandsassy/plugin-grok'),
                ], ['public']);

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('tallandsassy/plugin-grok'),
            ], 'grok.views');*/

            // Publishing the translation files.
//            $this->publishes([
//               $this->loadTranslationsFrom(__DIR__ . '/../resources/lang/', static::$language_prefix),
//            ], 'tallandsassy.plugin-grok');



            // Registering package commands.
            $this->commands(
                [
                    PluginGrokCommand::class,
                ]
            );
        }

        // Translation
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang/', static::$language_prefix);
        if ($this->app->runningInConsole()) {
            $to = "{$this->app['path.lang']}/vendor/".static::$language_prefix; //resources/lang/tallandsassy/plugin-grok
            $this->publishes([
               __DIR__.'/../resources/lang' => $to,
            ], 'tallandsassy.plugin-grok');
        }

        // Views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'tassy');


        Route::macro(
            'tassy',
            function (string $prefix) {
                Route::prefix($prefix)->group(
                    function () {
                        // Prefix Route Samples -BEGIN-
                        // Sample routes that only show while developing...
                        if (App::environment(['local', 'testing'])) {
                            // prefixed url to string
                            Route::get(
                                '/TallAndSassy/PluginGrok/sample_string', // you will absolutely need a prefix in your url
                                function () {
                                    return "Hello PluginGrok string via blade prefix";
                                }
                            );

                            // prefixed url to blade view
                            Route::get(
                                '/TallAndSassy/PluginGrok/sample_grok_bridge_blade',
                                function () {
                                    return view('tassy::sample_grok_bridge_blade');
                                }
                            );

                            // prefixed url to controller
                            Route::get(
                                '/TallAndSassy/PluginGrok/controller',
                                [PluginGrokController::class, 'sample']
                            );
                        }
                        // Prefix Route Samples -END-

                        // TODO: Add your own prefixed routes here...
                    }
                );
            }
        );
        Route::tassy('tassy'); // This works. http://test-jet.test/tassy/TallAndSassy/PluginGrok/string
        // They are addatiive, so in your own routes/web.php file, do Route::tassy('staff'); to
        // make http://test-jet.test/staff/TallAndSassy/PluginGrok/string work


        // global url samples -BEGIN-
        if (App::environment(['local', 'testing'])) {
            // global url to string
            Route::get(
                '/grok/TallAndSassy/PluginGrok/sample_string',
                function () {
                    return "Hello PluginGrok string via global url.";
                }
            );

            // global url to blade view
            Route::get(
                '/grok/TallAndSassy/PluginGrok/sample_blade',
                function () {
                    return view('tassy::sample_blade');
                }
            );

            // global url to controller
            Route::get('/grok/TallAndSassy/PluginGrok/controller', [PluginGrokController::class, 'sample']);
        }
        // global url samples -END-

        // TODO: Add your own global routes here...

        // GROK
        if (App::environment(['local', 'testing'])) {
            \ElegantTechnologies\Grok\GrokWrangler::grokMe(static::class, 'TallAndSassy', 'plugin-grok', 'resources/views/grok', 'tassy');//tassy gets macro'd out
            Route::get('/grok/TallAndSassy/PluginGrok', fn () => view('tassy::grok/index'));
        }

        // TODO: Register your livewire components that live in this package here:
        # \Livewire\Livewire::component('tassygroklivewirejet::a-a-nothing',  \TallAndSassy\GrokLivewireJet\Components\DemoUiChunks\AANothing::class);
        \Livewire\Livewire::component('tassy::livewire.grok-bridge',  \TallAndSassy\PluginGrok\Components\GrokBridge::class);
        // TODO: Add your own other boot related stuff here...

        // TODO: Add your own admin menu items here
        /*
         * ring $handle, string $Label, ?string $SvgHtml, ?string $IconName, ?string $urlIfNoFurtherChildren_nullIfGroup, ?string $IconSizingClasses = null
         *
         *
         */
        \TallAndSassy\PageGuide\MenuTree::singleton('lower')->ensureTop( // 'lower' puts items down low.
                'dev', // Key
                'Dev',         // $Label
                null,//$SvgHtml
                'fab-connectdevelop', // $IconNameVisit: https://blade-ui-kit.com/blade-icons/heroicon-o-home
                null, //$urlIfNoFurtherChildren_nullIfGroup
                null //$IconSizingClasses
        )
            ->pushGroup('admin.dev.grok', 'Grok')
            ->pushLink('admin.dev.grok.main', 'Main', '/grok');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/plugin-grok.php', 'plugin-grok');
    }

    public static function migrationFileExists(string $migrationFileName): bool
    {
        $len = strlen($migrationFileName);
        foreach (glob(database_path("migrations/*.php")) as $filename) {
            if ((substr($filename, -$len) === $migrationFileName)) {
                return true;
            }
        }

        return false;
    }
}
