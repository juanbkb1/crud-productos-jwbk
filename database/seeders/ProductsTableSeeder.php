<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        // 1. Limpiar tablas (forma segura con relaciones)
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Product::query()->delete();
        Category::query()->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // 2. Crear 5 categorías
        $categories = [
            'Electrónicos',
            'Ropa',
            'Hogar',
            'Deportes',
            'Juguetes'
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }

        // 3. Crear 10 productos con categorías aleatorias
        $products = [
            ['name' => 'Smartphone X10', 'category_id' => 1],
            ['name' => 'Zapatos deportivos', 'category_id' => 2],
            ['name' => 'Sofá de cuero', 'category_id' => 3],
            ['name' => 'Balón de fútbol', 'category_id' => 4],
            ['name' => 'Set de Lego', 'category_id' => 5],
            ['name' => 'Laptop Pro', 'category_id' => 1],
            ['name' => 'Camiseta algodón', 'category_id' => 2],
            ['name' => 'Juego de sábanas', 'category_id' => 3],
            ['name' => 'Raqueta tenis', 'category_id' => 4],
            ['name' => 'Muñeca articulada', 'category_id' => 5]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}