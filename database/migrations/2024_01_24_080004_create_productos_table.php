<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string("codigo_referencia")->unique()->default('PROD-' . uniqid());
            $table->string("nombre");
            $table->double("precio", 10);
            $table->string("imagen");
            $table->enum('formato', ['20CL', '25CL', '33CL', "1L", "Barril"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
