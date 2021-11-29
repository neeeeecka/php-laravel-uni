<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use phpDocumentor\Reflection\PseudoTypes\LowercaseString;

class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(10, true);
        $slug = strtolower(str_replace(" ", "-", $title));

        return [
                "title" => $title,
                "body" => $this->faker->paragraph(),
                "slug" =>  $slug,
                "created_at" => $this->faker->dateTime(),
                "updated_at" => $this->faker->dateTime(),
                "author" => $this->faker->name(),
                "category" => "main",
                "image" => $this->faker->image('public/storage/images', 400,300, null, false)
        ];
    }
}