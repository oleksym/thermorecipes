<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recipie_id');
            $table->string('title')->nullable();
            $table->tinyInteger('type')->unsigned()->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('order')->unsigned()->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('recipie_id')->references('id')->on('recipies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredient_groups');
    }
}
