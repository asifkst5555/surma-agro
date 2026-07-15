<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FixAllProductImagesSeeder extends Seeder
{
    public function run(): void
    {
        // Map: product_id => exact image filename (URL-encoded path stored in DB)
        // Base paths (URL-encoded):
        $export   = 'Surma%20Agro%20Products/Export%20Items/';
        $frozen   = 'Surma%20Agro%20Products/Frozen%20Export%20Items/';
        $dried    = 'Surma%20Agro%20Products/Dried%20Fish%20Export%20Items/';
        $import   = 'Surma%20Agro%20Products/Import%20Items/';

        $map = [
            // ══════════════════════════════════════════
            // CAT 1 — Export Items (36 products)
            // ══════════════════════════════════════════
            1  => $export . 'Betel%20Nut%20%28split%2C%20slices%29.webp',
            2  => $export . 'Betel%20Nut%20%28whole%29.webp',
            3  => $export . 'Black%20Cumin%20Seeds.webp',
            4  => $export . 'Coriander%20Seeds.webp',
            5  => $export . 'Cumin%20Seeds.webp',
            6  => $export . 'Dry%20Yellow%20Corn.webp',
            7  => $export . 'All%20kinds%20of%20Beans.webp',
            8  => $export . 'Velvet%20Beans.webp',
            9  => $export . 'Groundnut.webp',
            10 => $export . 'Niger%20Seeds.webp',
            11 => $export . 'Fresh%20Ginger.webp',
            12 => $export . 'Dried%20Ginger%20Whole.webp',
            13 => $export . 'Dried%20Ginger%20Slices.webp',
            14 => $export . 'Ginger%20Powder.webp',
            15 => $export . 'Turmeric%20Finger.webp',
            16 => $export . 'Turmeric%20Powder.webp',
            17 => $export . 'Garlic.webp',
            18 => $export . 'Onions.webp',
            19 => $export . 'Tamarind%20with%20Seeds.webp',
            20 => $export . 'Tamarind%20Seedless.webp',
            21 => $export . 'Tamarind%20Seeds.webp',
            22 => $export . 'Dried%20Gooseberry.webp',
            23 => $export . 'Gooseberry%20%28Amla%29%20Powder.webp',
            24 => $export . 'Dried%20Sweet%20Plum.webp',
            25 => $export . 'Lajwanti.webp',
            26 => $export . 'Reetha%20%28round%20soap%20nut%29.webp',
            27 => $export . 'Shikakai%20%28long%20soap%20nut%29.webp',
            28 => $export . 'Broom%20Stick.webp',
            29 => $export . 'Broom%20Grass.webp',
            30 => $export . 'Natural-Gum-Grade_-A1.webp',   // keep original (no spaces)
            114 => $export . 'Natural-Gum-Grade_-A1.webp',
            115 => $export . 'Natural-Gum-Grade_-A2.webp',
            116 => $export . 'Natural-Gum-Grade_-A3.webp',
            117 => $export . 'Natural-Gum-Grade_-A4.webp',
            118 => $export . 'Natural-Gum-Grade_-B.webp',
            119 => $export . 'Rice.webp',

            // ══════════════════════════════════════════
            // CAT 2 — Frozen Export Items (19 products)
            // ══════════════════════════════════════════
            31 => $frozen . 'Frozen%20Hilsa.webp',
            32 => $frozen . 'Frozen%20Featherback%20Fish.webp',
            33 => $frozen . 'Frozen%20Silver%20Pomfret.webp',
            34 => $frozen . 'Frozen%20Catfish%20%28body%29.webp',
            35 => $frozen . 'Frozen%20Catfish%20%28head%29.webp',
            36 => $frozen . 'Frozen%20Katla.webp',
            37 => $frozen . 'Frozen%20Keski.webp',
            38 => $frozen . 'Frozen%20Koral.webp',
            39 => $frozen . 'Frozen%20Lotia.webp',
            40 => $frozen . 'frozen%20mrigal.webp',
            41 => $frozen . 'Frozen%20Pangush.webp',
            42 => $frozen . 'Frozen%20Rahu.webp',
            43 => $frozen . 'Frozen%20Star%20Baim.webp',
            44 => $frozen . 'Striped%20Dwarf%20Catfish.webp',
            45 => $frozen . 'Frozen%20Threadfin%20Fish.webp',
            47 => $frozen . '18.webp',                        // Frozen Betel Nut -> 18.webp
            48 => $frozen . 'Frozen%20Jengkoll.webp',
            49 => $frozen . 'Frozen%20Durian.webp',
            120 => $frozen . 'Frozen%20%20shol%20Fish.webp',  // note double space in filename

            // ══════════════════════════════════════════
            // CAT 4 — Dried Fish Export Items (32 products)
            // ══════════════════════════════════════════
            76  => $dried . 'Golden%20Dried%20Shrimp%20%28small%29.webp',
            77  => $dried . 'Gaint%20Tiger%20Prawn.webp',
            78  => $dried . 'Dried%20Shrimp.webp',
            79  => $dried . 'Dried%20Hilsa%20Fish.webp',
            80  => $dried . 'Dried%20Silver%20Pomfret%20%28mixed%29.webp',
            81  => $dried . 'Dried%20Yellowfin%20Fish.webp',
            82  => $dried . 'Dried%20Talang%20Queenfish.webp',
            83  => $dried . 'Dried%20Sea%20Catfish.webp',
            84  => $dried . 'Dried%20Koral%20Fish%20%28H.L%29.webp',
            85  => $dried . 'Dried%20Mackerel%20Fish.webp',
            86  => $dried . 'Dried%20Pama%20Croaker.webp',
            87  => $dried . 'Dried%20Pama%20Croaker%20%28H.L%29.webp',
            88  => $dried . 'Dried%20Shol%20Fish.webp',
            89  => $dried . 'Dried%20Star%20Baim%20Fish.webp',
            90  => $dried . 'Dried%20Tilapia.webp',
            91  => $dried . 'Dried%20Bata%20Fish.webp',
            92  => $dried . 'Dried%20Garfish.webp',
            93  => $dried . 'Dried%20Palato.webp',
            94  => $dried . 'Dried%20Lotia%20Fish.webp',
            95  => $dried . 'Dried%20Anchovy.webp',
            96  => $dried . 'Dried%20Keski.webp',
            97  => $dried . 'Dried%20Kurau%20Fish.webp',
            98  => $dried . 'Dried%20Long%20Tail%20Fish.webp',
            99  => $dried . 'Dried%20Striped%20Dwarf%20Catfish.webp',
            100 => $dried . 'Dried%20Stringray%20Fish%20%28slices%29.webp',
            101 => $dried . 'Dried%20Hairfin%20Anchovy%20Fish.webp',
            102 => $dried . 'Dried%20Ribbon%20Fish%20%28H.L%29%20round.webp',
            103 => $dried . 'Dried%20Ribbon%20Fish%20%28H.L%29%20mixed.webp',
            104 => $dried . 'Dried%20Ribbon%20big.webp',
            105 => $dried . 'Dried%20Ribbon%20small.webp',
            106 => $dried . 'Dried%20Ribbon%20Fish%20%28H.L%29.webp',
            107 => $dried . 'dried%20ribbon%20%28H%29.webp',

            // ══════════════════════════════════════════
            // CAT 5 — Import Items (7 products)
            // ══════════════════════════════════════════
            108 => $import . 'All%20Kind%20of%20Spices.webp',
            109 => $import . 'Black%20Pepper.webp',
            110 => $import . 'Black%2C%20Red%20Salt.webp',
            111 => $import . 'Licorice%20Root.webp',
            112 => $import . 'Raisins%20%28Kismis%29.webp',
            113 => $import . 'Fenugreek.webp',
            121 => $import . 'Cumin%20Seeds.webp',
        ];

        $ok      = 0;
        $missing = 0;

        foreach ($map as $productId => $encodedPath) {
            // Verify file physically exists before updating
            $decoded  = urldecode($encodedPath);
            $fullPath = storage_path('app/public/' . $decoded);

            if (file_exists($fullPath)) {
                DB::table('products')->where('id', $productId)
                    ->update(['featured_image' => $encodedPath, 'updated_at' => now()]);
                $this->command->info("✅  ID {$productId} => {$encodedPath}");
                $ok++;
            } else {
                $this->command->warn("❌  ID {$productId} FILE NOT FOUND: {$fullPath}");
                $missing++;
            }
        }

        $this->command->newLine();
        $this->command->info("Done — {$ok} updated, {$missing} missing files.");
    }
}
