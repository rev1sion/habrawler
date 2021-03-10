<?php

namespace Database\Seeders;

use App\Models\Tag\Tag;
use App\Models\Post\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(3)->create();
        Post::factory(5)
            ->has(Tag::factory(2)->count(1))
            ->create();
    }
}
