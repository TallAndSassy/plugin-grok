<?php


namespace TallAndSassy\PluginGrok\Tests\Feature\Http\Controllers;

class PluginGrokControllerTest extends \TallAndSassy\PluginGrok\Tests\TestCase
{
    /** @test */
    public function global_urls_returns_ok()
    {
        // Test hard-coded routes...
        $this
            ->get('/grok/TallAndSassy/PluginGrok/sample_string')
            ->assertOk()
            ->assertSee('Hello PluginGrok string via global url.');
        $this
            ->get('/grok/TallAndSassy/PluginGrok/sample_blade')
            ->assertOk()
            ->assertSee('Hello PluginGrok from blade in TallAndSassy/PluginGrok/groks/sample_blade');
        $this
            ->get('/grok/TallAndSassy/PluginGrok/controller')
            ->assertOk()
            ->assertSee('Hello PluginGrok from: TallAndSassy\PluginGrok\Http\Controllers\PluginGrokController::sample');
    }


    /** @test */
    public function prefixed_urls_returns_ok()
    {
        // Test user-defined routes...
        // Reproduce in routes/web.php like so
        //  Route::tassy('staff');
        //  http://test-tallandsassy.test/staff/TallAndSassy/PluginGrok/string
        //  http://test-tallandsassy.test/staff/TallAndSassy/PluginGrok/blade
        //  http://test-tallandsassy.test/staff/TallAndSassy/PluginGrok/controller
        $userDefinedBladePrefix = $this->userDefinedBladePrefix; // user will do this in routes/web.php Route::tassy('url');

        // string
        $this
            ->get("/$userDefinedBladePrefix/TallAndSassy/PluginGrok/sample_string")
            ->assertOk()
            #->assertSee('hw(TallAndSassy\PluginGrok\Http\Controllers\PluginGrokController)');
        ->assertSee('Hello PluginGrok string via blade prefix');

        // blade
        $this
            ->get("/$userDefinedBladePrefix/TallAndSassy/PluginGrok/sample_blade")
            ->assertOk()
            ->assertSee('Hello PluginGrok from blade in TallAndSassy/PluginGrok/groks/sample_blade');

        // controller
        $this
            ->get("/$userDefinedBladePrefix/TallAndSassy/PluginGrok/controller")
            ->assertOk()
            ->assertSee('Hello PluginGrok from: TallAndSassy\PluginGrok\Http\Controllers\PluginGrokController::sample');
    }
}
