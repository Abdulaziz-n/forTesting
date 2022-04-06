<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCVSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_v_s', function (Blueprint $table) {
            $table->id();
            $table->string('position');
            $table->string('name');
            $table->string('date_of_birth');
            $table->string('nationality');
            $table->string('marital_status');
            $table->string('city');
            $table->string('district');
            $table->string('street');
            $table->string('phone');
            $table->string('email');
            $table->string('stir');
            $table->string('education');
            $table->string('speciality');
            $table->string('education_place');
            $table->string('date_finished');
            $table->string('enter_happy');
            $table->string('additional_information');
            $table->string('file');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('c_v_s');
    }
}
