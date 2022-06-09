<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use TheBachtiarz\Toolkit\Config\Interfaces\Data\ToolkitConfigInterface;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toolkit_configs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('access_group', 2)->default(ToolkitConfigInterface::TOOLKIT_CONFIG_PUBLIC_CODE);
            $table->boolean('is_enable')->default(1);
            $table->boolean('is_encrypt')->default(0);
            $table->text('value');
            $table->timestamps();
        });

        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('toolkit_configs');
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
    }
};
