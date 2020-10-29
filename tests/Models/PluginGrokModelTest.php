<?php

namespace TallAndSassy\PluginGrok\Tests\Feature\Models;

use TallAndSassy\PluginGrok\Models\PluginGrokModel;
use TallAndSassy\PluginGrok\Tests\TestCase;

class PluginGrokModelTest extends TestCase
{
    /** @test */
    public function it_can_create_a_model()
    {
        $model = PluginGrokModel::create(['name' => 'John']);
        $this->assertDatabaseCount('plugin-grok', 1);
        $this->assertEquals('JOHN', $model->getUpperCasedName());
    }
}
