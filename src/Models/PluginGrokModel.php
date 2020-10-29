<?php

namespace TallAndSassy\PluginGrok\Models;

use Illuminate\Database\Eloquent\Model;

class PluginGrokModel extends Model
{
    public $gaurded = [];// Defualt to no mass assignements
    public $fillable = ['name'];
    public $table = 'plugin-grok';

    public function getUpperCasedName() : string
    {
        return strtoupper($this->name);
    }
}
