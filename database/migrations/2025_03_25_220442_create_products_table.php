<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // ID automático
            $table->string('name'); // Nombre del producto (ej: "Laptop HP")
            $table->foreignId('category_id')->constrained(); // Relación con categorías
            $table->timestamps(); // Fechas de creación/actualización
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};