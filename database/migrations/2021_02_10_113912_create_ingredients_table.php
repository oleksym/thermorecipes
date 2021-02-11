<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ingredient_group_id');
            $table->string('name')->nullable();
            $table->string('amount')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('order')->unsigned()->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('ingredient_group_id')->references('id')->on('ingredient_groups');
            $table->foreign('unit_id')->references('id')->on('units');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredients');
    }
}
