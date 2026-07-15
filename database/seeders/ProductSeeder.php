<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::truncate();

        $categories = Category::pluck('id', 'slug');

        $exportItems = [
            'Betel Nut (split, slices)', 'Betel Nut (whole)',
            'Black Cumin Seeds', 'Coriander Seeds',
            'Cumin Seeds', 'Dry Yellow Corn',
            'All kinds of Beans', 'Velvet Beans',
            'Groundnut', 'Niger Seeds',
            'Fresh Ginger', 'Dried Ginger Whole',
            'Dried Ginger Slices', 'Ginger Powder',
            'Turmeric Finger', 'Turmeric Powder',
            'Garlic', 'Onions',
            'Tamarind with Seeds', 'Tamarind Seedless',
            'Tamarind Seeds', 'Dried Gooseberry',
            'Gooseberry (Amla) Powder', 'Dried Sweet Plum',
            'Lajwanti', 'Reetha (round soap nut)',
            'Shikakai (long soap nut)', 'Broom Stick',
            'Broom Grass', 'Natural Gum (Grade A1, A2, A3, A4, and Grade B)',
        ];

        $frozenItems = [
            'Frozen Hilsa', 'Frozen Featherback Fish',
            'Frozen Silver Pomfret', 'Frozen Catfish (body)',
            'Frozen Catfish (head)', 'Frozen Katia',
            'Frozen Keski', 'Frozen Koral',
            'Frozen Lotia', 'Frozen Mrigal',
            'Frozen Pangush', 'Frozen Rahu',
            'Frozen Star Baim Fish', 'Frozen Striped Dwarf Catfish',
            'Frozen Threadfin Fish', 'Frozen Bai',
            'Frozen Betel Nut', 'Frozen Jengkoll',
            'Frozen Durian',
        ];

        $processedItems = [
            'Chilli Powder', 'Meat Masala',
            'Roasted Vermicelli', 'City Balachong',
            'Dried Anchovy with Chilli', 'Dried Shrimp with Chilli',
            'Fried Dried Anchovy with Chilli', 'Fried Dry Golden Shrimp (small)',
            'Fried Dry Lotia with Chilli', 'Dried Chilli Pepper (big & small)',
            'Special Fried Garlics (Big, Medium, and Small pieces)', 'Fried Onions',
            'Instant Salted Fresh Water Fish', 'Lime Stone Paste (White & Red)',
            'Roasted Soya Chunks', 'Salted Soya Bean',
            'Taunggyi Roasted Beans (sweet)', 'Plum Sugar 100%',
            'Mango Pickle', 'Mayanthi Pickle',
            'Pickled Curcuma Amada', 'Pickled Dahendi',
            'Pickled Marian Plum', 'Pickled White Bamboo Shoots',
            'Pickled Yellow Bamboo Shoots', 'Pickled Young Tamarind Leaves',
        ];

        $driedFishItems = [
            'Golden Dried Shrimp (small)', 'Giant Tiger Prawn',
            'Dried Shrimp', 'Dried Hilsa Fish',
            'Dried Silver Pomfret (mixed)', 'Dried Yellowfin Fish',
            'Dried Talang Queenfish', 'Dried Sea Catfish',
            'Dried Koral Fish (H.L)', 'Dried Mackerel Fish',
            'Dried Pama Croaker', 'Dried Pama Croaker (H.L)',
            'Dried Shol Fish', 'Dried Star Baim Fish',
            'Dried Tilapia', 'Dried Bata Fish',
            'Dried Garfish', 'Dried Palato',
            'Dried Lotia Fish', 'Dried Anchovy',
            'Dried Keski', 'Dried Kurau Fish',
            'Dried Long Tail Fish', 'Dried Striped Dwarf Catfish',
            'Dried Stingray Fish (slices)', 'Dried Hairfin Anchovy Fish',
            'Dried Ribbon Fish (H.L) round', 'Dried Ribbon Fish (H.L) mixed',
            'Dried Ribbon big', 'Dried Ribbon small',
            'Dried Ribbon Fish (H.L)', 'Dried Ribbon (H)',
        ];

        $importItems = [
            'All Kinds of Spices', 'Black Pepper',
            'Black, Red Salt', 'Licorice Root',
            'Raisins (Kismis)', 'Fenugreek',
        ];

        $map = [
            'export-items' => $exportItems,
            'frozen-export-items' => $frozenItems,
            'processed-food-products' => $processedItems,
            'dried-fish-export-items' => $driedFishItems,
            'import-items' => $importItems,
        ];

        foreach ($map as $slug => $products) {
            $categoryId = $categories[$slug] ?? null;
            if (!$categoryId) continue;

            foreach ($products as $name) {
                Product::create([
                    'category_id' => $categoryId,
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'short_description' => "Premium quality {$name} sourced from trusted producers, compliant with international export standards.",
                    'origin' => 'Bangladesh',
                    'moq' => null,
                    'packaging' => 'As per buyer requirement',
                    'export_capacity' => 'As per order',
                    'is_active' => true,
                    'is_featured' => false,
                ]);
            }
        }

        $this->command->info('All products from official catalog seeded successfully.');
    }
}
