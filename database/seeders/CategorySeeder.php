<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // categories_id = 1
        Category::factory()->create([
            'name'            => 'Motora',
            'user_creator_id' => '1',
        ]);

        // categories_id = 2
        Category::factory()->create([
            'name'            => 'Social',
            'user_creator_id' => '1',
        ]);

        // categories_id = 3
        Category::factory()->create([
            'name'            => 'Alimenticia',
            'user_creator_id' => '1',
        ]);

        // categories_id = 4
        Category::factory()->create([
            'name'            => 'Educacional',
            'user_creator_id' => '1',
        ]);

        // categories_id = 5
        Category::factory()->create([
            'name'            => 'Bons hábitos ',
            'user_creator_id' => '1',
        ]);

        // categories_id = 6
        Category::factory()->create([
            'name'            => 'Emocional',
            'user_creator_id' => '1',
        ]);

         // categories_id = 7
        Category::factory()->create([
            'name'            => 'Organizacional',
            'user_creator_id' => '1',
        ]);
    }
}
