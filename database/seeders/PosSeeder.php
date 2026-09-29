<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class PosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat Kategori
        $sembako = Category::create([
            'name' => 'Sembako',
            'description' => 'Kebutuhan pokok sehari-hari'
        ]);

        $minuman = Category::create([
            'name' => 'Minuman',
            'description' => 'Aneka minuman segar dan kemasan'
        ]);

        $snack = Category::create([
            'name' => 'Makanan Ringan',
            'description' => 'Snack dan makanan ringan'
        ]);

        // 2. Buat Produk berelasi dengan Kategori
        Product::create([
            'category_id' => $sembako->id,
            'code' => 'BRS001',
            'name' => 'Beras Premium 5kg',
            'unit' => 'Sak',
            'price' => 75000,
            'stock' => 20,
        ]);

        Product::create([
            'category_id' => $sembako->id,
            'code' => 'MNY001',
            'name' => 'Minyak Goreng 2L',
            'unit' => 'Pouch',
            'price' => 32000,
            'stock' => 15,
        ]);

        Product::create([
            'category_id' => $minuman->id,
            'code' => 'THB001',
            'name' => 'Teh Botol Sosro 450ml',
            'unit' => 'Botol',
            'price' => 5000,
            'stock' => 50,
        ]);

        Product::create([
            'category_id' => $snack->id,
            'code' => 'IND001',
            'name' => 'Indomie Goreng Special',
            'unit' => 'Pcs',
            'price' => 3500,
            'stock' => 100,
        ]);
    }
}
