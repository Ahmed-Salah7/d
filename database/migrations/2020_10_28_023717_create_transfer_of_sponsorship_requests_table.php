<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransferOfSponsorshipRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_of_sponsorship_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('customer_id_current')->nullable();
            $table->integer('worker_id');
            $table->integer('customer_id_new')->nullable();
            $table->date('date_transfer_sponsorship');
            $table->float('cost_transfer_sponsorship');
            $table->date('expiration_date_experiment');
            $table->float('daily_salary');
            $table->string('attatches')->nullable();
            $table->longText('notes')->nullable();
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
        Schema::dropIfExists('transfer_of_sponsorship_requests');
    }
}
