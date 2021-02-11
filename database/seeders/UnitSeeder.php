<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $units = ['g', 'kg', 'ml', 'l', 'tablespoon', 'teaspoon', 'clove', 'slice', 'bunch'];
        foreach ($units as $unit) {
            Unit::create(['name' => $unit]);
        }
    }
}
