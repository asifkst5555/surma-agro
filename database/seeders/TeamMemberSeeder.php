<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        $teamMembers = [
            [
                'name' => 'Kazi Tanzid Hossain',
                'designation' => 'Managing Director',
                'company' => 'Surma River Fish Ltd',
                'bio' => 'Visionary leader steering Surma River Fish Ltd toward global excellence in seafood and agriculture trade with decades of industry expertise.',
                'image' => '/storage/Surma_Team/Kazi Tanzid Hossain.webp',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Afroja Akther',
                'designation' => 'Director',
                'company' => 'Surma River Fish Ltd',
                'bio' => 'Dedicated director driving strategic growth and operational excellence at Surma River Fish Ltd.',
                'image' => '/storage/Surma_Team/Afroja Akther.webp',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Shafayet Ullah',
                'designation' => 'Director',
                'company' => 'Surma River Fish Ltd',
                'bio' => 'Accomplished director contributing to the expansion and success of Surma River Fish Ltd.',
                'image' => '/storage/Surma_Team/Shafayet Ullah.webp',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'KAWSAR AHMED',
                'designation' => 'Countries Director (USA)',
                'company' => 'SURMA RIVER WAVES INC',
                'bio' => 'Leading Surma River Waves Inc. operations across the United States, driving market expansion and client relationships.',
                'image' => '/storage/Surma_Team/KAWSAR AHMED.webp',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Zahidul Islam Monir',
                'designation' => 'Countries Director (Canada)',
                'company' => 'SURMA FOOD INC.',
                'bio' => 'Head of Surma Food Inc. in Canada, managing operations and growing the brand across North American markets.',
                'image' => '/storage/Surma_Team/Zahidul Islam Monir.webp',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Md. Abdur Rahman',
                'designation' => 'Countries Director (Oman)',
                'company' => 'LPT Business and Contracting LLC',
                'bio' => 'Overseeing LPT Business and Contracting LLC operations in Oman, strengthening Middle Eastern market presence.',
                'image' => '/storage/Surma_Team/Md. Abdur Rahman.webp',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'Mr. Nazmul HUDA',
                'designation' => 'Countries Director (Bangladesh)',
                'company' => 'Surma Fish Dhaka Office',
                'bio' => 'Managing Surma Fish Dhaka Office, coordinating domestic operations and international export logistics.',
                'image' => '/storage/Surma_Team/Mr. Nazmul HUDA.webp',
                'sort_order' => 7,
                'is_active' => true,
            ],
        ];

        foreach ($teamMembers as $member) {
            TeamMember::create($member);
        }

        $this->command->info('Team members seeded successfully.');
    }
}
