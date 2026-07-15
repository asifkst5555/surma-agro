<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Statistic;
use App\Models\Certificate;
use App\Models\Office;
use App\Models\TimelineEntry;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Categories
        $categories = [
            ['name' => 'Export Items', 'slug' => 'export-items', 'type' => 'export', 'description' => 'Premium agricultural commodities and raw materials for global markets.', 'sort_order' => 1],
            ['name' => 'Frozen Export Items', 'slug' => 'frozen-export-items', 'type' => 'frozen', 'description' => 'High-quality frozen seafood and fish products.', 'sort_order' => 2],
            ['name' => 'Processed Food Products', 'slug' => 'processed-food-products', 'type' => 'processed', 'description' => 'Value-added processed food products for international B2B buyers.', 'sort_order' => 3],
            ['name' => 'Dried Fish Export Items', 'slug' => 'dried-fish-export-items', 'type' => 'dried', 'description' => 'Traditionally processed dried fish products.', 'sort_order' => 4],
            ['name' => 'Import Items', 'slug' => 'import-items', 'type' => 'import', 'description' => 'Products imported for domestic distribution.', 'sort_order' => 5],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Statistics
        $stats = [
            ['label' => 'Countries Served', 'value' => 30, 'suffix' => '+', 'sort_order' => 1],
            ['label' => 'Years Experience', 'value' => 25, 'suffix' => '+', 'sort_order' => 2],
            ['label' => 'Shipments Annually', 'value' => 500, 'suffix' => '+', 'sort_order' => 3],
            ['label' => 'Product Categories', 'value' => 50, 'suffix' => '+', 'sort_order' => 4],
        ];

        foreach ($stats as $stat) {
            Statistic::create($stat);
        }

        // Offices
        $offices = [
            ['country' => 'Bangladesh', 'city' => 'Dhaka', 'address' => 'House 12, Road 5, Gulshan, Dhaka 1212', 'phone' => '+95 9797100016', 'email' => 'bd@surmaagro.com', 'is_head_office' => true, 'sort_order' => 1, 'flag_icon' => '🇧🇩'],
            ['country' => 'United States', 'city' => 'New York', 'address' => '425 Lexington Avenue, New York, NY 10017', 'phone' => '+1 212 555 0198', 'email' => 'us@surmaagro.com', 'sort_order' => 2, 'flag_icon' => '🇺🇸'],
            ['country' => 'Thailand', 'city' => 'Bangkok', 'address' => '123 Sukhumvit Road, Bangkok 10110', 'phone' => '+66 2 123 4567', 'email' => 'th@surmaagro.com', 'sort_order' => 3, 'flag_icon' => '🇹🇭'],
            ['country' => 'Saudi Arabia', 'city' => 'Riyadh', 'address' => 'King Fahd Road, Riyadh 12211', 'phone' => '+966 11 234 5678', 'email' => 'sa@surmaagro.com', 'sort_order' => 4, 'flag_icon' => '🇸🇦'],
        ];

        foreach ($offices as $office) {
            Office::create($office);
        }

        // Certificates
        $certificates = [
            ['name' => 'ISO 9001:2015', 'issuing_body' => 'International Organization for Standardization', 'description' => 'Quality Management System certification ensuring consistent quality in all operations.', 'sort_order' => 1],
            ['name' => 'HACCP Certified', 'issuing_body' => 'Food Safety Management System', 'description' => 'Hazard Analysis Critical Control Point certification for food safety.', 'sort_order' => 2],
            ['name' => 'GMP Certified', 'issuing_body' => 'Good Manufacturing Practices', 'description' => 'Ensuring products are consistently produced and controlled according to quality standards.', 'sort_order' => 3],
            ['name' => 'Organic Certification', 'issuing_body' => 'USDA Organic / EU Organic', 'description' => 'Certified organic products meeting international organic standards.', 'sort_order' => 4],
            ['name' => 'FSSC 22000', 'issuing_body' => 'Food Safety System Certification', 'description' => 'Comprehensive food safety management system certification.', 'sort_order' => 5],
            ['name' => 'BRCGS', 'issuing_body' => 'Brand Reputation Compliance Global Standard', 'description' => 'Global standard for food safety and quality management.', 'sort_order' => 6],
            ['name' => 'Halal Certified', 'issuing_body' => 'Islamic Food and Nutrition Council', 'description' => 'Halal certification for compliance with Islamic dietary laws.', 'sort_order' => 7],
            ['name' => 'Export License', 'issuing_body' => 'Bangladesh Export Promotion Bureau', 'description' => 'Official export license authorizing international trade operations.', 'sort_order' => 8],
        ];

        foreach ($certificates as $cert) {
            Certificate::create($cert);
        }

        // Timeline
        $timeline = [
            ['year' => '2000', 'title' => 'Foundation of Surma Agro', 'description' => 'Surma Agro was established in Bangladesh with a vision to connect local agricultural producers with international markets.', 'sort_order' => 1],
            ['year' => '2005', 'title' => 'First International Export', 'description' => 'Successfully completed our first major export shipment to the Middle East, marking our entry into global trade.', 'sort_order' => 2],
            ['year' => '2010', 'title' => 'ISO 9001 Certification', 'description' => 'Achieved ISO 9001:2008 certification, establishing formal quality management systems across operations.', 'sort_order' => 3],
            ['year' => '2013', 'title' => 'Expansion to 10 Countries', 'description' => 'Expanded export operations to 10 countries across Asia, Middle East, and Europe.', 'sort_order' => 4],
            ['year' => '2015', 'title' => 'HACCP Certification', 'description' => 'Obtained HACCP certification for food safety management, enabling entry into regulated food markets.', 'sort_order' => 5],
            ['year' => '2017', 'title' => 'US Office Opening', 'description' => 'Established our United States office in New York to serve the North American market directly.', 'sort_order' => 6],
            ['year' => '2018', 'title' => '30 Countries Milestone', 'description' => 'Reached 30 countries served, with significant presence in Asia, Europe, North America, and Africa.', 'sort_order' => 7],
            ['year' => '2020', 'title' => 'Surma Fish Brand Launch', 'description' => 'Launched the Surma Fish sub-brand, specializing in premium frozen and processed fish products.', 'sort_order' => 8],
            ['year' => '2022', 'title' => 'Thailand Office Expansion', 'description' => 'Opened Southeast Asia regional hub in Bangkok, Thailand, strengthening our Asian supply chain.', 'sort_order' => 9],
            ['year' => '2024', 'title' => 'Digital Transformation', 'description' => 'Launched comprehensive digital platform for B2B trade management and client engagement.', 'sort_order' => 10],
            ['year' => '2025', 'title' => '500+ Products & Saudi Office', 'description' => 'Exceeded 500 product variants and opened Middle East office in Riyadh, Saudi Arabia.', 'sort_order' => 11],
        ];

        foreach ($timeline as $entry) {
            TimelineEntry::create($entry);
        }

        $this->call([
            TeamMemberSeeder::class,
            DemoSeeder::class,
        ]);
    }
}
