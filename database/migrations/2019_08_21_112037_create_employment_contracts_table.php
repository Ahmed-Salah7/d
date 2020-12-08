<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmploymentContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employment_contracts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('customer_id')->nullable();
            $table->string('contract_number',255)->nullable();
            $table->date('date_of_contract')->nullable();
            $table->string('second_party',255)->nullable();
            $table->string('duration_of_the_contract',255)->nullable();
            $table->string('contract_value',255)->nullable();
            $table->float('taxes_included')->nullable()->comment('1=yes,2=no')->nullable();
            $table->string('discount',255)->nullable();
            $table->string('visa_fees',255)->nullable();
            $table->string('visa_number',255)->nullable();
            $table->date('visa_date')->nullable();
            $table->date('corresponding_to_ad')->nullable();
            $table->string('occupation',255)->nullable();
            $table->string('nationality',255)->nullable();
            $table->string('destination',255)->nullable();
            $table->string('monthly_salary',255)->nullable();
            $table->string('contract_source',255)->nullable();
            $table->string('arrival_airport',255)->nullable();
            $table->string('holiday_days',255)->nullable();
            $table->string('delay_per_day',255)->nullable();
            $table->string('number_of_applicants',255)->nullable();
            $table->string('religion',255)->nullable();
            $table->string('age',255)->nullable();
            $table->string('terms_and_advantages',255)->nullable();
            $table->string('client',255)->nullable();
            $table->string('to_me',255)->nullable();
            $table->string('qualifications_and_experience',255)->nullable();
            $table->string('cost_center',255)->nullable();
            $table->string('the_currency',255)->nullable();
            $table->string('marketer',255)->nullable();
            $table->string('marketer_fare',255)->nullable();
            $table->string('mission_history',255)->nullable();
            $table->text('extradata')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('employment_contracts');
    }
}
