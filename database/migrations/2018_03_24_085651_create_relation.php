<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees',function(Blueprint $table) {
            $table->foreign('department_id')->references('id')->on('departments');
        });

        Schema::table('document_requests',function(Blueprint $table) {
            $table->foreign('requestor_id')->references('id')->on('employees');
        });

        Schema::table('leave_forms',function(Blueprint $table) {

            $table->foreign('request_id')->references('id')->on('document_requests');

        });


        Schema::table('ticket_details',function(Blueprint $table) {

            $table->foreign('request_id')->references('id')->on('document_requests');

        });

        Schema::table('ticket_costing',function(Blueprint $table) {

            $table->foreign('ticket_details_id')->references('id')->on('ticket_details');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('employees',function(Blueprint $table) {

            $table->dropForeign(['department_id']);

        });

        Schema::table('document_requests',function(Blueprint $table) {

            $table->dropForeign(['requestor_id']);

        });

        Schema::table('leave_forms',function(Blueprint $table) {

            $table->dropForeign(['request_id']);

        });

        Schema::table('ticket_details',function(Blueprint $table) {

            $table->dropForeign('request_id');

        });

        Schema::table('ticket_costing',function(Blueprint $table) {

            $table->dropForeign('ticket_details_id');

        });




    }
}
