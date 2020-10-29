<?php


namespace TallAndSassy\PluginGrok\Tests\Feature\Commands;

class PluginGrokCommandTest extends \TallAndSassy\PluginGrok\Tests\TestCase
{
    /** @test */
    public function test_command_works()
    {
        $this->artisan('tassy:somecommand')->assertExitCode(0);
        $this->artisan('tassy:somecommand')->expectsOutput('TallAndSassy/PluginGrok/hw/tbd');
    }
}
