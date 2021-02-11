<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;
use App\Models\IngredientGroup;
use App\Models\Ingredient;
use App\Models\RecipeStep;
use App\Models\Unit;
use App\Models\User;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $units = Unit::all();

        $user = new User(['name' => 'name', 'email' => 'email@email.com', 'password' => \Hash::make('test_password')]);
        $user->save();

        $recipe = new Recipe([
            'title' => 'First recipe',
            'user_id' => $user->id,
            'duration' => 60,
            'source' => 'Great Cook Book',
            'difficulty' => Recipe::DIFFICULTY_LEVELS['EASY'],
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'published_at' => now(),
        ]);
        $recipe->save();

        $group = new IngredientGroup([
            'title' => 'Dough',
            'type' => IngredientGroup::GROUP_TYPES['DOUGH'],
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
        ]);
        $recipe->ingredientGroups()->save($group);

        $ing1 = new Ingredient([
            'name' => 'flour',
            'amount' => '500',
            'unit_id' => $units->where('name', 'kg')->first()->id,
            'order' => 1,
        ]);
        $group->ingredients()->save($ing1);

        $ing2 = new Ingredient([
            'name' => 'water',
            'amount' => '300',
            'unit_id' => $units->where('name', 'ml')->first()->id,
            'order' => 2,
        ]);
        $group->ingredients()->save($ing2);

        $ing3 = new Ingredient([
            'name' => 'yeast',
            'amount' => '20',
            'unit_id' => $units->where('name', 'g')->first()->id,
            'order' => 3,
        ]);
        $group->ingredients()->save($ing3);

        $step = new RecipeStep([
            'description' => "Put [ingredient:{$ing1->id}] into a bowl",
            'order' => 1,
        ]);
        $group->recipeSteps()->save($step);

        $step = new RecipeStep([
            'description' => "Add [ingredient:{$ing2->id}]",
            'order' => 2,
        ]);
        $group->recipeSteps()->save($step);

        $step = new RecipeStep([
            'description' => "Then add [ingredient:{$ing3->id}] and mix it.",
            'order' => 3,
        ]);
        $group->recipeSteps()->save($step);
    }
}
