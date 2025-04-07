<?php

namespace Database\Factories;

use App\Domain\Link\Models\Link;
use App\Domain\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LinkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Link::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'       => $this->faker->sentence(2),
            'original'   => $this->faker->url,
            'code'       => $this->faker->unique()->regexify('[A-Za-z0-9]{6}'),
            'partition'  => $this->faker->randomElement(
                ['default', 'partition1', 'partition2']
            ),
            'user_id'    => User::factory(),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
