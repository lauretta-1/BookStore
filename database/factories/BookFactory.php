<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::all()->pluck('id')->toArray();
        return [
            'title'=>$this->faker->name,
            'description'=>$this->faker->sentence,
            'cover_image'=>$this->faker->image('public/storage/books',640,480, null, false),
            'price'=>(string)$this->faker->year,
            'author' => $this->faker->randomElement($users)
        
        ];
    }
}
