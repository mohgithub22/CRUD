<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Article;

use Carbon\Factory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->count(10)->create()->each(function ($user) {
            $user->articles()->saveMany(Article::factory()->count(10)->make());
        });



        // User::factory(10)->create();
        // $this->call([ArticleTableSeeder::class]);

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
