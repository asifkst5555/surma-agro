<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\GalleryItem;
use App\Models\Career;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        Blog::query()->delete();
        GalleryItem::query()->delete();
        Career::query()->delete();
        Setting::query()->delete();

        // Blogs
        $blogs = [
            [
                'title' => 'The Rising Global Demand for Bangladeshi Frozen Fish: Opportunities for Importers',
                'slug' => 'rising-global-demand-bangladeshi-frozen-fish',
                'excerpt' => 'Explore the factors driving the global demand for Bangladeshi frozen fish and find key procurement strategies for international B2B importers.',
                'content' => "The global seafood industry is undergoing a massive structural shift. Driven by a rising worldwide population, increasing health consciousness, and a growing appreciation for lean protein sources, the demand for high-quality seafood has reached unprecedented heights. Amid this escalating global demand, international B2B buyers, wholesalers, and supermarkets are actively seeking reliable, high-yield sourcing hubs. Bangladesh has emerged as one of the most promising and dynamic players in this landscape, particularly in the sector of frozen fish and crustacean exports.\n\nHistorically known for its fertile deltaic plains, Bangladesh is uniquely positioned to cater to international seafood markets. Blessed with an intricate network of rivers, estuaries, and a vast coastline along the Bay of Bengal, the country boasts some of the most biodiverse aquatic ecosystems in the world. Sourcing from Bangladesh presents a lucrative opportunity to diversify supply chains, tap into premium wild-caught and aquaculture species, and secure highly competitive pricing. Sourcing directly from an exporter like Surma Agro removes intermediate broker fees and trading house margins, ensuring a smooth, highly profitable import process from the factory floor to your warehouse.",
                'image' => '/storage/Surma Agro Products/Blog/The Rising Global Demand for Bangladeshi Frozen Fish.webp',
                'author' => 'Surma Agro Trade Team',
                'category' => 'Seafood Export',
                'tags' => ['frozen-fish', 'export', 'seafood-trade'],
                'is_published' => true,
                'published_at' => now()->subDays(1),
            ],
            [
                'title' => 'From Farm to Global Markets: How Surma Agro Ensures Quality at Every Step',
                'slug' => 'farm-to-global-markets-quality-control',
                'excerpt' => 'A deep dive into Surma Agro\'s rigorous food safety and quality control systems across the entire agricultural export supply chain.',
                'content' => "At Surma Agro, quality is not just a department — it is a culture. Every product that leaves our facilities undergoes multiple quality checks to ensure it meets strict international standards.\n\nOur quality control process begins directly at the source. We work closely with certified farmers and producers who follow Good Agricultural Practices (GAP). Our field inspectors regularly visit production sites to verify compliance, soil quality, and crop health. Once products arrive at our facilities, they go through thorough inspection including visual examination, laboratory testing, and packaging verification.\n\nWe hold ISO 9001:2015, HACCP, GMP, and FSSC 22000 certifications, demonstrating our commitment to quality at every level. By enforcing these rigorous standards, we ensure that our global partners receive clean, safe, and premium-quality agricultural products.",
                'image' => '/storage/Surma Agro Products/Blog/From Farm to Global Markets How Surma Agro Ensures Quality at Every.webp',
                'author' => 'Quality Assurance Team',
                'category' => 'Quality Control',
                'tags' => ['quality-assurance', 'compliance', 'food-safety'],
                'is_published' => true,
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Sustainable Agriculture in Bangladesh: Building a Better Future',
                'slug' => 'sustainable-agriculture-bangladesh',
                'excerpt' => 'How sustainable farming practices, eco-friendly logistics, and green sourcing are transforming agricultural export in Bangladesh.',
                'content' => "Sustainability is at the heart of our operations. We believe that responsible sourcing and environmental stewardship are essential for long-term success in the agricultural export industry.\n\nOur sustainability initiatives include partnering with farmers who use eco-friendly farming practices, reducing chemical fertilizers, and introducing organic nutrients. In our seafood division, we practice integrated mangrove-shrimp cultivation, preserving coastal mangrove buffers while harvesting premium Black Tiger shrimp naturally. We are also optimizing shipping routes to minimize carbon footprint and transitioning to biodegradable packaging materials. By supporting local communities and practicing green agriculture, we ensure a sustainable supply of premium agricultural commodities for global B2B buyers.",
                'image' => '/storage/Surma Agro Products/Blog/Sustainable Agriculture in Bangladesh Building a Better Future.webp',
                'author' => 'Sustainability Department',
                'category' => 'Sustainability',
                'tags' => ['eco-friendly', 'green-farming', 'sustainable-food'],
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'How to Choose a Reliable Agricultural Export Partner',
                'slug' => 'choose-reliable-agricultural-export-partner',
                'excerpt' => 'Key criteria and evaluation checklists for international buyers seeking a trustworthy, compliant agricultural trade partner.',
                'content' => "Sourcing agricultural products globally comes with challenges. For international buyers, wholesalers, and supermarkets, selecting the right export partner is the single most critical decision in the supply chain.\n\nTo ensure a successful partnership, buyers must evaluate potential partners on key criteria: 1. Regulatory Compliance (verify HACCP, ISO, and FDA registrations); 2. Cold Chain Integrity (ensure temperature-controlled reefer logistics); 3. Financial Stability (ensure flexible trade instruments like Irrevocable Letters of Credit are supported); 4. Supply Consistency (verify raw material sourcing capacity). Surma Agro stands out on all fronts, providing transparent operations and dependable trade execution that global importers trust.",
                'image' => '/storage/Surma Agro Products/Blog/How to Choose a Reliable Agricultural Export Partner.webp',
                'author' => 'B2B Trade Advisor',
                'category' => 'Trade Advice',
                'tags' => ['sourcing', 'export-partner', 'b2b-trade'],
                'is_published' => true,
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => 'Understanding the Agricultural Export Process: A Complete Guide for International Buyers',
                'slug' => 'understanding-agricultural-export-process',
                'excerpt' => 'A comprehensive overview of international documentation, shipping logistics, and customs procedures for agricultural trade.',
                'content' => "Importing agricultural commodities requires a deep understanding of trade regulations, customs clearance, and logistical steps. A standard transaction follows a structured path: 1. Proforma Invoice & Contract Negotiation; 2. Financial Instrument setup (typically Irrevocable Letter of Credit); 3. Sourcing and Packaging (ensuring multilingual labeling and proper glazing); 4. Document Preparation (Bill of Lading, Health Certificates, and Certificate of Origin); 5. Customs Clearance and Port Loading.\n\nBy partnering with a seasoned exporter like Surma Agro, buyers receive end-to-end documentation support and priority shipping line allocations, ensuring cargo arrives on schedule without costly demurrage fees.",
                'image' => '/storage/Surma Agro Products/Blog/Understanding the Agricultural Export Process A Complete Guide for.webp',
                'author' => 'Logistics Department',
                'category' => 'Logistics',
                'tags' => ['export-logistics', 'trade-documentation', 'customs'],
                'is_published' => true,
                'published_at' => now()->subDays(9),
            ],
            [
                'title' => 'Why Bangladesh Is Emerging as a Global Agricultural Export Hub',
                'slug' => 'bangladesh-emerging-agricultural-export-hub',
                'excerpt' => 'An analysis of Bangladesh\'s trade growth, strategic deltaic advantages, and expansion into international agricultural markets.',
                'content' => "Bangladesh is rapidly transitioning into a major global agricultural export hub. Blessed with fertile deltaic soils, an abundant river network, and favorable climatic conditions, the country produces high-yield crops and seafood year-round.\n\nGovernment incentives for agro-processing, port infrastructure modernizations (including Chittagong and Mongla ports), and private sector investments in advanced cold chain networks have driven phenomenal export growth. Today, Bangladeshi agricultural exports reach buyers in over 30 countries across Europe, North America, the Middle East, and Asia. Surma Agro is proud to drive this expansion, supplying premium rice, fresh vegetables, processed food, and frozen seafood to international B2B markets.",
                'image' => '/storage/Surma Agro Products/Blog/Why Bangladesh Is Emerging as a Global Agricultural Export Hub.webp',
                'author' => 'Market Research Analyst',
                'category' => 'Market Insights',
                'tags' => ['bangladesh-trade', 'agricultural-hub', 'global-markets'],
                'is_published' => true,
                'published_at' => now()->subDays(12),
            ],
        ];

        foreach ($blogs as $blog) {
            Blog::create($blog);
        }

        // Gallery Items
        $galleryItems = [
            ['title' => 'Premium Rice Processing', 'description' => 'Fully automated sorting and processing at our state-of-the-art rice mill.', 'image' => '/storage/Surma Agro Products/gallery/gallery (1).webp', 'category' => 'Factory', 'type' => 'image', 'sort_order' => 1, 'is_active' => true],
            ['title' => 'High-Quality Sesame Seeds', 'description' => 'Premium grade sesame seeds cleaned and packed for export.', 'image' => '/storage/Surma Agro Products/gallery/gallery (2).webp', 'category' => 'Products', 'type' => 'image', 'sort_order' => 2, 'is_active' => true],
            ['title' => 'Modern Packaging Line', 'description' => 'Export-ready packaging line for premium grain selection.', 'image' => '/storage/Surma Agro Products/gallery/gallery (3).webp', 'category' => 'Factory', 'type' => 'image', 'sort_order' => 3, 'is_active' => true],
            ['title' => 'Cold Storage Logistics', 'description' => 'Strict temperature monitoring at our warehousing facilities.', 'image' => '/storage/Surma Agro Products/gallery/gallery (4).webp', 'category' => 'Logistics', 'type' => 'image', 'sort_order' => 4, 'is_active' => true],
            ['title' => 'Fresh Potato Selection', 'description' => 'Locally sourced potatoes graded and ready for global delivery.', 'image' => '/storage/Surma Agro Products/gallery/gallery (5).webp', 'category' => 'Products', 'type' => 'image', 'sort_order' => 5, 'is_active' => true],
            ['title' => 'Quality Control Testing', 'description' => 'Rigorous lab test verification of all agricultural products.', 'image' => '/storage/Surma Agro Products/gallery/gallery (6).webp', 'category' => 'Quality', 'type' => 'image', 'sort_order' => 6, 'is_active' => true],
            ['title' => 'B2B Export Packing', 'description' => 'Packing organic crops in robust containers for shipping.', 'image' => '/storage/Surma Agro Products/gallery/gallery (7).webp', 'category' => 'Logistics', 'type' => 'image', 'sort_order' => 7, 'is_active' => true],
            ['title' => 'Dedicated Logistics Fleet', 'description' => 'Swift distribution network executing global shipments on time.', 'image' => '/storage/Surma Agro Products/gallery/gallery (8).webp', 'category' => 'Logistics', 'type' => 'image', 'sort_order' => 8, 'is_active' => true],
            ['title' => 'Frozen Fish Storage', 'description' => 'Maintaining freshness with advanced IQF cooling systems.', 'image' => '/storage/Surma Agro Products/gallery/gallery (9).webp', 'category' => 'Products', 'type' => 'image', 'sort_order' => 9, 'is_active' => true],
        ];

        foreach ($galleryItems as $item) {
            GalleryItem::create($item);
        }

        // Career Listings
        $careers = [
            [
                'title' => 'Export Manager',
                'slug' => 'export-manager',
                'department' => 'Export Operations',
                'location' => 'Dhaka, Bangladesh',
                'type' => 'full-time',
                'short_description' => 'Lead our export operations team in managing international trade relationships and expanding market reach.',
                'description' => "We are seeking an experienced Export Manager to lead our export operations team. The ideal candidate will have extensive knowledge of international trade regulations, logistics management, and client relationship building.\n\nKey Responsibilities:\n- Manage end-to-end export operations\n- Develop and maintain client relationships across international markets\n- Ensure compliance with international trade regulations\n- Coordinate with logistics partners for timely shipments\n- Prepare export documentation and manage letters of credit",
                'requirements' => [
                    '5+ years experience in export/import management',
                    'Strong knowledge of international trade regulations',
                    'Excellent communication and negotiation skills',
                    'Experience in agro-commodity exports preferred',
                    'Bachelor\'s degree in Business or International Trade',
                    'Proficiency in English; additional languages a plus',
                ],
                'benefits' => [
                    'Competitive salary with performance bonuses',
                    'Health and life insurance',
                    'International travel opportunities',
                    'Professional development programs',
                ],
                'deadline' => now()->addDays(30),
                'is_active' => true,
            ],
            [
                'title' => 'Quality Assurance Officer',
                'slug' => 'quality-assurance-officer',
                'department' => 'Quality Control',
                'location' => 'Chittagong, Bangladesh',
                'type' => 'full-time',
                'short_description' => 'Ensure our products meet international quality standards through rigorous inspection and testing procedures.',
                'description' => "We are looking for a Quality Assurance Officer to join our team at the Chittagong processing facility. The role involves ensuring all products meet ISO, HACCP, and other international standards.\n\nKey Responsibilities:\n- Conduct quality inspections at various stages of processing\n- Maintain quality documentation and records\n- Coordinate with production team on quality issues\n- Implement corrective actions for non-compliance\n- Conduct internal audits",
                'requirements' => [
                    '3+ years in food quality assurance',
                    'Knowledge of HACCP, ISO 9001, and GMP standards',
                    'Bachelor\'s degree in Food Technology or related field',
                    'Attention to detail and strong analytical skills',
                    'Certification in quality management preferred',
                ],
                'benefits' => [
                    'Competitive salary',
                    'Health insurance',
                    'Training and certification support',
                ],
                'deadline' => now()->addDays(45),
                'is_active' => true,
            ],
            [
                'title' => 'Supply Chain Coordinator',
                'slug' => 'supply-chain-coordinator',
                'department' => 'Logistics',
                'location' => 'Dhaka, Bangladesh',
                'type' => 'full-time',
                'short_description' => 'Coordinate the movement of goods from suppliers to customers, optimizing efficiency and cost-effectiveness.',
                'description' => "Join our logistics team as a Supply Chain Coordinator. You will be responsible for coordinating shipments, managing inventory, and optimizing our supply chain operations.\n\nKey Responsibilities:\n- Coordinate international and domestic shipments\n- Manage inventory levels and warehousing\n- Track shipments and provide updates to clients\n- Optimize shipping routes for cost and time efficiency\n- Maintain shipping documentation",
                'requirements' => [
                    '2+ years in supply chain or logistics',
                    'Knowledge of international shipping procedures',
                    'Proficiency in MS Office and logistics software',
                    'Strong organizational skills',
                    'Bachelor\'s degree in Supply Chain or related field',
                ],
                'benefits' => [
                    'Competitive salary',
                    'Health insurance',
                    'Career growth opportunities',
                ],
                'deadline' => now()->addDays(60),
                'is_active' => true,
            ],
            [
                'title' => 'Marketing Specialist (Digital)',
                'slug' => 'marketing-specialist-digital',
                'department' => 'Marketing',
                'location' => 'Remote / Dhaka',
                'type' => 'contract',
                'short_description' => 'Drive our digital marketing efforts and enhance our online presence in international B2B markets.',
                'description' => "We are seeking a creative Digital Marketing Specialist to enhance our brand presence and generate leads through digital channels.\n\nKey Responsibilities:\n- Manage social media accounts and content strategy\n- Develop and execute email marketing campaigns\n- Create engaging content for website and marketing materials\n- Analyze campaign performance metrics\n- Support trade show and event marketing efforts",
                'requirements' => [
                    '3+ years in digital marketing',
                    'Experience with B2B marketing preferred',
                    'Proficiency in social media management tools',
                    'Strong writing and content creation skills',
                    'Knowledge of SEO and analytics tools',
                    'Bachelor\'s degree in Marketing or Communications',
                ],
                'benefits' => [
                    'Flexible remote work',
                    'Project-based compensation',
                    'Portfolio-building opportunity',
                ],
                'deadline' => now()->addDays(20),
                'is_active' => true,
            ],
        ];

        foreach ($careers as $career) {
            Career::create($career);
        }

        // Settings
        $settings = [
            ['key' => 'company_name', 'value' => 'Surma Agro', 'group' => 'general'],
            ['key' => 'company_email', 'value' => 'info@surmaagro.com', 'group' => 'general'],
            ['key' => 'company_phone', 'value' => '+95 9797100016', 'group' => 'general'],
            ['key' => 'company_address', 'value' => 'House 12, Road 5, Gulshan, Dhaka 1212, Bangladesh', 'group' => 'general'],
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/surmaagro', 'group' => 'social'],
            ['key' => 'twitter_url', 'value' => 'https://twitter.com/surmaagro', 'group' => 'social'],
            ['key' => 'linkedin_url', 'value' => 'https://linkedin.com/company/surmaagro', 'group' => 'social'],
            ['key' => 'whatsapp_number', 'value' => '+959797100016', 'group' => 'social'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }

        $this->command->info('Demo data seeded: blogs, gallery, careers, settings.');
    }
}
