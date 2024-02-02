<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


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

    // Obtener la lista de archivos en la carpeta storage/app/public/images/
    $imageFiles = Storage::files('public/images');

    // Seleccionar una imagen al azar de la lista
    $randomImage = $this->faker->randomElement($imageFiles);

    // Obtener el nombre de la imagen
    $imageName = pathinfo($randomImage, PATHINFO_BASENAME);

    return [
        'codigo_referencia' => 'PROD-' . $this->faker->unique()->regexify('[A-Za-z0-9]{5}'),
        'nombre' => $this->faker->sentence,
        'precio' => $this->faker->randomFloat(2, 1, 100),
        'imagen' => asset('storage/images/' . $imageName),
        'formato' => $this->faker->randomElement(['20CL', '25CL', '33CL', '1L', 'Barril']),
        'created_at' => now(),
        'updated_at' => now(),
    ];
}

private function getRandomImage(): string
{
    // Obtener la lista de archivos en la carpeta storage/images/
    $imageFiles = Storage::files('images');

    // Seleccionar una imagen al azar de la lista
    $randomImage = $this->faker->randomElement($imageFiles);

    // Obtener la ruta relativa de la imagen
    $relativePath = str_replace('storage/', 'storage/app/', $randomImage);

    return $relativePath;
}
}
