<?php

namespace Database\Factories;

use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Status::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'status' => $this->faker->randomElement([Status::ACTIVE_USER, Status::INACTIVE_USER]),
            'position' => Status::POSITIONS[rand(0, count(Status::POSITIONS)-1)]
        ];
    }
}
