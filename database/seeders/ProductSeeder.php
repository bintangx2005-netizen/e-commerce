<?php

namespace Database\Seeders;

use App\Models\MultiImage;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory(10)->has(MultiImage::factory(5), 'multiple_images')->create();
    }
}
