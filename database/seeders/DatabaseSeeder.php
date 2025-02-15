<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()
            ->has(Post::factory()->count(10))
            ->withAvatar()
            ->create([
                'name' => 'Al Nahian',
                'email' => 'nahian@admin.com',
            ]);
    }
}
