<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCvTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cv', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('occupation')->nullable();
            $table->integer('nationality')->nullable();
            $table->string('religion')->nullable();
            $table->integer('age')->nullable();
            $table->integer('previous_experience')->comment('1=Experience,2=Not Experience')->nullable();
            $table->integer('office_id')->nullable();
            $table->string('passport_number')->nullable();
            $table->integer('reservation')->comment('1=reservation,2=Not reservation')->nullable();
            $table->integer('status')->comment('1=Active,2=Deactive')->nullable();
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
        Schema::dropIfExists('cv');
    }
}
