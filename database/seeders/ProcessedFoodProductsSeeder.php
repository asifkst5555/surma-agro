<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProcessedFoodProductsSeeder extends Seeder
{
    public function run(): void
    {
        $categoryId = 3; // Processed Food Products
        $basePath   = 'Surma Agro Products/Processed Food Products/';

        // ── Step 1: Delete ALL existing products in this category ──
        DB::table('products')->where('category_id', $categoryId)->delete();

        // ── Step 2: The 28 products mapped exactly to their image filenames ──
        $products = [
            [
                'name'              => 'Chilli Powder',
                'image'             => $basePath . 'Chilli Powder.webp',
                'short_description' => 'Finely ground premium chilli powder.',
            ],
            [
                'name'              => 'Coriander Powder',
                'image'             => $basePath . 'Coriander Powder.webp',
                'short_description' => 'Freshly ground coriander powder for cooking.',
            ],
            [
                'name'              => 'Cumin Powder',
                'image'             => $basePath . 'Cumin Powder.webp',
                'short_description' => 'Aromatic cumin powder for seasoning.',
            ],
            [
                'name'              => 'Turmeric Powder',
                'image'             => $basePath . 'Turmeric Powder.webp',
                'short_description' => 'Pure natural turmeric powder.',
            ],
            [
                'name'              => 'Meat Masala',
                'image'             => $basePath . 'Meat Masala.webp',
                'short_description' => 'Specially blended meat masala spice mix.',
            ],
            [
                'name'              => 'Dried Anchovy with Chilli',
                'image'             => $basePath . 'Dried Anchovy with Chilli.webp',
                'short_description' => 'Sun-dried anchovies blended with chilli.',
            ],
            [
                'name'              => 'Dried Shrimp with Chilli',
                'image'             => $basePath . 'Dried Shrimp with Chilli.webp',
                'short_description' => 'Premium dried shrimp mixed with chilli.',
            ],
            [
                'name'              => 'Fried Dried Anchovy with Chilli',
                'image'             => $basePath . 'Fried Dried Anchovy with Chilli.webp',
                'short_description' => 'Crispy fried dried anchovy with chilli seasoning.',
            ],
            [
                'name'              => 'Fried Lotia with Chilli',
                'image'             => $basePath . 'Fried lotia with chili.webp',
                'short_description' => 'Crispy fried lotia fish with chilli.',
            ],
            [
                'name'              => 'Golden Shrimp',
                'image'             => $basePath . 'Golden shrimp.webp',
                'short_description' => 'Premium golden dried shrimp.',
            ],
            [
                'name'              => 'Dried Chilli Pepper (Big)',
                'image'             => $basePath . 'Dried Chilli Pepper (big).webp',
                'short_description' => 'Large sun-dried chilli peppers.',
            ],
            [
                'name'              => 'Dried Chilli Pepper (Small)',
                'image'             => $basePath . 'Dried Chilli Pepper (small).webp',
                'short_description' => 'Small sun-dried chilli peppers.',
            ],
            [
                'name'              => 'Fried Garlic (Big Pieces)',
                'image'             => $basePath . 'Fried Garlic (Big Pirces).webp',
                'short_description' => 'Crispy fried garlic in big pieces.',
            ],
            [
                'name'              => 'Fried Garlic (Medium Pieces)',
                'image'             => $basePath . 'Fried Garlic (Medium Pieces).webp',
                'short_description' => 'Crispy fried garlic in medium pieces.',
            ],
            [
                'name'              => 'Fried Garlic (Small Pieces)',
                'image'             => $basePath . 'Fried Garlic (small Pieces).webp',
                'short_description' => 'Crispy fried garlic in small pieces.',
            ],
            [
                'name'              => 'Fried Onions',
                'image'             => $basePath . 'Fried Onions.webp',
                'short_description' => 'Golden crispy fried onions.',
            ],
            [
                'name'              => 'Lime Stone Paste (Red)',
                'image'             => $basePath . 'Lime Stone Paste (Red).webp',
                'short_description' => 'Traditional red lime stone paste.',
            ],
            [
                'name'              => 'Lime Stone Paste (White)',
                'image'             => $basePath . 'Lime Stone Paste (white).webp',
                'short_description' => 'Traditional white lime stone paste.',
            ],
            [
                'name'              => 'Salted Soya Bean',
                'image'             => $basePath . 'Salted Soya Bean.webp',
                'short_description' => 'Naturally fermented salted soya bean.',
            ],
            [
                'name'              => 'Taunggyi Roasted Beans (Sweet)',
                'image'             => $basePath . 'Taunggyi Roasted Beans (sweet).webp',
                'short_description' => 'Sweet roasted beans from Taunggyi.',
            ],
            [
                'name'              => 'Plum Sugar',
                'image'             => $basePath . 'Plum Sugar.webp',
                'short_description' => '100% natural plum sugar.',
            ],
            [
                'name'              => 'Mango Pickle',
                'image'             => $basePath . 'Mango Pickle.webp',
                'short_description' => 'Traditional tangy mango pickle.',
            ],
            [
                'name'              => 'Mayanthi Pickle',
                'image'             => $basePath . 'Mayanthi Pickle.webp',
                'short_description' => 'Classic Mayanthi style pickle.',
            ],
            [
                'name'              => 'Pickled Marian Plum',
                'image'             => $basePath . 'Pickled Marian Plum.webp',
                'short_description' => 'Tangy pickled Marian plum.',
            ],
            [
                'name'              => 'Pickled White Bamboo Shoots',
                'image'             => $basePath . 'Pickled White Bamboo Shoots.webp',
                'short_description' => 'Crisp pickled white bamboo shoots.',
            ],
            [
                'name'              => 'Pickled Yellow Bamboo Shoots',
                'image'             => $basePath . 'Pickled Yellow Bamboo Shoots.webp',
                'short_description' => 'Tender pickled yellow bamboo shoots.',
            ],
            [
                'name'              => 'Pickled Young Tamarind Leaves',
                'image'             => $basePath . 'Pickled Young Tamarind Leaves.webp',
                'short_description' => 'Delicate pickled young tamarind leaves.',
            ],
            [
                'name'              => 'Special Mixed Spice (28)',
                'image'             => $basePath . '28.webp',
                'short_description' => 'Special blend of 28 mixed spices.',
            ],
        ];

        // ── Step 3: Insert all 28 products ──
        $now = now();
        foreach ($products as $product) {
            DB::table('products')->insert([
                'category_id'       => $categoryId,
                'name'              => $product['name'],
                'slug'              => Str::slug($product['name']) . '-' . Str::random(4),
                'short_description' => $product['short_description'],
                'description'       => $product['short_description'],
                'featured_image'    => $product['image'],
                'is_active'         => 1,
                'is_featured'       => 0,
                'created_at'        => $now,
                'updated_at'        => $now,
            ]);
        }

        $this->command->info('✅ Processed Food Products: deleted old, inserted 28 matched products.');
    }
}
