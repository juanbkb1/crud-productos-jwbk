<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Esto crea un ID automático
            $table->string('name'); // Nombre de la categoría (ej: "Electrónicos")
            $table->timestamps(); // Crea campos de fecha de creación y actualización
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
};