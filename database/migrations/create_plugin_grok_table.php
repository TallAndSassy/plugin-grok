<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePluginGrokTable extends Migration
{
    public function up()
    {
        Schema::create('plugin-grok', function (Blueprint $table) {
            $table->bigIncrements('id');

            // add fields
            $table->string('name')->comment("Name of Guy");//

            $table->timestamps();
        });
    }
}
