<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costomers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('id_number')->nullable();
            $table->string('place_of_issue')->nullable();
            $table->string('nationality')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('home_number')->nullable();
            $table->string('work_place')->nullable();
            $table->string('address')->nullable();
            $table->string('title')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->integer('status')->comment('1=Active,2=Deactive')->nullable();
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
        Schema::dropIfExists('costomers');
    }
}
