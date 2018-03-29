<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_roles', function (Blueprint $table) {
            
            $table->integer('user_id')->unsigned()->index();
            
            $table->integer('role_id')->unsigned()->index();

            $table->primary(['user_id','role_id']);
            

            $table->foreign('user_id')

                ->references('id')

                ->on('users');

              //foreign key
            $table->foreign('role_id')

                ->references('id')

                ->on('roles');

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
        Schema::dropIfExists('user_roles');

        Schema::table('user_roles',function(Blueprint $table) {
            
            $table->dropForeign(['role_id'])->references('id')->on('roles');

            $table->dropForeign(['user_id'])->references('id')->on('user_id');
            
        });
    }
}
