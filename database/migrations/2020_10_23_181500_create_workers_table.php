<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('sponser_name');
            $table->integer('nationality_id');
            $table->integer('profession_id')->nullable();
            $table->integer('age');
            $table->date('enter_date');
            $table->string('passport_number');
            $table->integer('office_id');
            $table->integer('accoumodation_type_id');
            $table->integer('religion_id');
            $table->integer('qualifications_and_rxperience_id');
            $table->string('passport_image')->nullable();
            $table->string('additional_attchements')->nullable();
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
        Schema::dropIfExists('workers');
    }
}
