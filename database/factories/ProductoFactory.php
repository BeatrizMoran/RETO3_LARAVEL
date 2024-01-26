<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Producto::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->unique()->word; // Reiniciar el contador de valores únicos

        return [
            'codigo_referencia' => 'PROD-' . $this->faker->unique()->regexify('[A-Za-z0-9]{5}'),
            'nombre' => $this->faker->sentence,
            'precio' => $this->faker->randomFloat(2, 1, 100),
            'imagen' => $this->faker->imageUrl(),
            'formato' => $this->faker->randomElement(['20CL', '25CL', '33CL', '1L', 'Barril']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
