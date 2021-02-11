<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameRecipiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('recipies', 'recipes');

        Schema::table('ingredient_groups', function (Blueprint $table) {
            $table->renameColumn('recipie_id', 'recipe_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('recipes', 'recipies');

        Schema::table('ingredient_groups', function (Blueprint $table) {
            $table->renameColumn('recipe_id', 'recipie_id');
        });
    }
}
