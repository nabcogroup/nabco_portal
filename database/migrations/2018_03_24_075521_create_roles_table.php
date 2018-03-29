<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            
            $table->increments('id');
            
            $table->string('name')->index();

            $table->string('description')->nullable();

            $table->boolean('can_view')->default(false);

            $table->boolean('can_add')->default(false);

            $table->boolean('can_update')->default(false);

            $table->boolean('can_delete')->default(false);

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
        Schema::dropIfExists('roles');
    }
}
