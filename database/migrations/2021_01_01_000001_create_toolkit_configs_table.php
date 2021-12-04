<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use TheBachtiarz\Toolkit\Config\Interfaces\Data\ToolkitConfigInterface;

class CreateToolkitConfigsTable extends Migration
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
            $table->string('name')->unique();
            $table->string('access_group', 2)->default(ToolkitConfigInterface::TOOLKIT_CONFIG_USER_CODE);
            $table->boolean('is_enable')->default(1);
            $table->boolean('is_encrypt')->default(0);
            $table->text('value');
            $table->timestamps();
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
    }
}
