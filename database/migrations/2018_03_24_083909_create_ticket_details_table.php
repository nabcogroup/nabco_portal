<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_details', function (Blueprint $table) {

            $table->increments('id');

            $table->string('doc_no')->unique();

            $table->integer('request_id')->unsigned();

            $table->date('confirmed_date');

            $table->dateTime('travel_date');

            $table->dateTime('returned_date');

            $table->string('country_destination');

            $table->string('country_origin');

            $table->string('country_return');

            $table->string('airlines');

            $table->string('booking_ref');

            $table->string('ticket_no');

            $table->decimal('ticket_cost');

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
        Schema::dropIfExists('table_ticket_details');
    }
}
