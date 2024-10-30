<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory 
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // has enum options for status that can be populated in the database
       $status = ['pending', 'overdue', 'canceled', 'completed'];

        return [
            'title' => $this->faker->unique()->words(4, true),
            'description' => $this->faker->sentence(4) ,
            'status' => $this->faker->randomElement($status),
            'due_date' => $this->faker->dateTimeBetween('now', '+4 weeks')
        ];
    }
}