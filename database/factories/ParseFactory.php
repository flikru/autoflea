<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Parse>
 */
class ParseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'address' => $this->faker->address(),
            'phone' =>$this->faker->phoneNumber(),
            'schedule' => "<div>Понедельник: 8:00 - 16:00</div><div>Вторник: 8:00 - 16:00</div><div>Среда: 8:00 - 16:00</div>",
            'description' =>$this->faker->text('35'),
            'notes' => $this->faker->text('15'),
            //
        ];
    }
}
