<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RiceExportProductsSeeder extends Seeder
{
    public function run(): void
    {
        $export = Category::where('type', 'export')->firstOrFail();

        $riceProducts = [
            'Parboiled Rice (5% Broken)'       => 'Parboiled%20Rice%20%285%25%20Broken%29.webp',
            'Parboiled Rice (100% Broken)'     => 'Parboiled%20Rice%20%28100%25%20Broken%29.webp',
            'Myanmar Premium Pawsan Rice (100%)' => 'Myanmar%20Premium%20Pawsan%20Rice%20%28100%25%29.webp',
            'Myanmar Pawsan Rice (5% Broken)'  => 'Myanmar%20Pawsan%20Rice%20%285%25%20Broken%29.webp',
            'Emata White Rice (100%)'          => 'Emata%20White%20Rice%20%28100%25%29.webp',
            'Emata White Rice (5% Broken)'     => 'Emata%20White%20Rice%20%285%25%20Broken%29.webp',
            'Emata White Rice (10% Broken)'    => 'Emata%20White%20Rice%20%2810%25%20Broken%29.webp',
            'Emata White Rice (15% Broken)'    => 'Emata%20White%20Rice%20%2815%25%20Broken%29.webp',
            'Emata White Rice (25% Broken)'    => 'Emata%20White%20Rice%20%2825%25%20Broken%29.webp',
            'Emata White Rice (35% Broken)'    => 'Emata%20White%20Rice%20%2835%25%20Broken%29.webp',
            'Emata White Rice (50% Broken)'    => 'Emata%20White%20Rice%20%2850%25%20Broken%29.webp',
            'Emata White Rice (100% Broken)'   => 'Emata%20White%20Rice%20%28100%25%20Broken%29.webp',
        ];

        $basePath = 'Surma%20Agro%20Products/Export%20Items/rice/';

        foreach ($riceProducts as $name => $encodedFilename) {
            $encodedPath = $basePath . $encodedFilename;
            $decodedPath = urldecode($encodedPath);
            $fullPath = storage_path('app/public/' . $decodedPath);

            if (!file_exists($fullPath)) {
                $this->command->warn("Image not found: {$fullPath} — skipping {$name}");
                continue;
            }

            $product = Product::create([
                'category_id'       => $export->id,
                'name'              => $name,
                'slug'              => Str::slug($name),
                'short_description' => "Premium quality {$name} sourced from trusted producers, compliant with international export standards.",
                'origin'            => 'Bangladesh',
                'moq'               => null,
                'packaging'         => 'As per buyer requirement',
                'export_capacity'   => 'As per order',
                'is_active'         => true,
                'is_featured'       => false,
                'featured_image'    => $encodedPath,
            ]);

            $this->command->info("✅ Created: {$name} (ID: {$product->id})");
        }

        $this->command->info('All rice export products seeded successfully.');
    }
}
