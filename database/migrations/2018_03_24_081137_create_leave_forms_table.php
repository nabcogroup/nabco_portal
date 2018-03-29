<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_forms', function (Blueprint $table) {
            
            $table->increments('id');

            $table->integer('request_id')->unsigned();

            $table->integer('employee_id');

            $table->date('leave_start');

            $table->integer('no_of_days');

            $table->string('purpose')->nullable();

            $table->string('country_of_destination');

            $table->string('person_contact_no')->nullable();

            $table->string('person_to_contact')->nullable();

            $table->string('place_to_stay')->nullable();

            $table->date('travel_date');

            $table->date('joined_date')->nullable();

            $table->string('status')->index();

            $table->string('resources')->nullable();

            $table->string('remarks')->nullable();


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
        Schema::dropIfExists('leave_forms');
    }
}
