<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Article::class;
    public function definition(): array
    {
        return [
            'user_id'=>5,
            'title'=>$this->faker->text(50),
            'slug_fa'=>$this->faker->slug(),
            'body' =>$this-> faker->paragraph(rand(5,20)),
            //
        ];
    }
}
