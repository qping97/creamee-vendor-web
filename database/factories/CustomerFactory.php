<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerFactory extends Factory
{
    use HasFactory;
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'contact_no' => "1234354545",
            'address' => $this->faker->address,
            'email' => $this->faker->email,
            'password' =>Hash::make('12345678'),
            'longitude' => "22.332",
            'latitude' => "100.2334",
            'isblock'=> "0",
            'profile_pic' => $this->faker->image('public/storage/category',640,480, null, false),
        ];
    }
}
