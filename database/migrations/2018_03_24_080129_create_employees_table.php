<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            
            $table->increments('id');
            
            $table->string('employee_no',50)->unique();

            $table->string('first_name',250);

            $table->string('last_name',250);

            $table->string('middle_name',250);

            $table->string('nationality');

            $table->string('passport_no',50)->unique();

            $table->string('qatar_id',50)->unique();

            $table->string('mobile_no',50);

            $table->date('date_joined');

            $table->text('configuration')->nullable();

            $table->integer('department_id')->unsigned();

            $table->softDeletes();
            
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
        Schema::dropIfExists('employees');
    }
}
