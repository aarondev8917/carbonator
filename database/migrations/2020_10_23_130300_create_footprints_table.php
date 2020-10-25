<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFootprintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footprints', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('activity')->unsigned();  // required
            $table->enum('activity_type',['fuel', 'miles'])->default('fuel');  //required
            $table->bigInteger('fuel_type_id')->unsigned(); 
            $table->index('fuel_type_id');
            $table->foreign('fuel_type_id')->references('id')->on('fuelType')->onDelete('cascade');
            $table->bigInteger('mode_id')->unsigned(); 
            $table->index('mode_id');
            $table->foreign('mode_id')->references('id')->on('modes')->onDelete('cascade');
            $table->char('country', 5); //required
            $table->mediumText('response');
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
        Schema::dropIfExists('footprints');
    }
}
