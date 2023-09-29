<?php

namespace Database\Factories;

use App\Models\Loja;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loja>
 */
class LojaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model
     *
     * @var string
     */
    protected $model = Loja::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            "nome" => $this->faker->name(),
            "url" => $this->faker->url(),
            "logo_url" => $this->faker->url(),
            "endereco" => $this->faker->streetName(),
            "numero" => $this->faker->numberBetween(1, 1000),
            "bairro" => $this->faker->streetName(),
            "cidade" => $this->faker->city(),
            "uf" => $this->faker->streetName(),
            "cep" => $this->faker->numberBetween(10000000, 99999999)
        ];
    }
}
