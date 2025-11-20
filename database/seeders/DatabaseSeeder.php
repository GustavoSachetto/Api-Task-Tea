<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\TaskUser;
use App\Models\AdvancedAccess;
use App\Models\UserRelationships;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\TaskSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\CategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            TaskSeeder::class,
        ]);

	    AdvancedAccess::factory(User::role('responsible')->count())->create();
        UserRelationships::factory(User::role('child')->count())->create();
        TaskUser::factory()->count(15)->create();
    }
}
