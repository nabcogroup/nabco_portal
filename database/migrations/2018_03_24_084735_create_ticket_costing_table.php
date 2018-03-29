<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketCostingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_costing', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('ticket_details_id')->unsigned();       //foreign key

            $table->integer('qualified_no_days');

            $table->decimal('approved_ticket_amount');

            $table->date('last_rejoined');

            $table->date('start_leave');

            $table->integer('no_of_work_days');

            $table->decimal('ticket_payable_amount');

            $table->decimal('confirmed_ticket_amount');

            $table->decimal('employee_charges_amount');

            $table->string('invoice_no');

            $table->string('statement');

            $table->string('agency_name');

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
        Schema::dropIfExists('table_ticket_costing');
    }
}
