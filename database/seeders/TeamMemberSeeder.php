<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            [
                'name' => ['ar' => 'محمد الشمري', 'en' => 'Mohammed Al-Shammari'],
                'position' => ['ar' => 'محامي أول ورئيس قسم التقاضي', 'en' => 'Senior Lawyer & Head of Litigation'],
                'photo' => 'team_member_1_mohammed_alshammari_1773655866906.png',
                'sort_order' => 1,
            ],
            [
                'name' => ['ar' => 'تركي الزهراني', 'en' => 'Turki Al-Zahrani'],
                'position' => ['ar' => 'مستشار قانوني - عقود وشركات', 'en' => 'Legal Consultant - Contracts & Corporate'],
                'photo' => 'team_member_2_turki_alzahrani_1773655906259.png',
                'sort_order' => 2,
            ],
            [
                'name' => ['ar' => 'نورة القحطاني', 'en' => 'Noura Al-Qahtani'],
                'position' => ['ar' => 'محامية ومستشارة قانوني', 'en' => 'Lawyer & Legal Consultant'],
                'photo' => 'team_member_3_noura_alqahtani_1773655981455.png',
                'sort_order' => 3,
            ],
            [
                'name' => ['ar' => 'عبدالله الدوساري', 'en' => 'Abdullah Al-Dosari'],
                'position' => ['ar' => 'محامي استئناف', 'en' => 'Appeal Lawyer'],
                'photo' => 'team_member_4_male_attorney_1_1773656040869.png',
                'sort_order' => 4,
            ],
            [
                'name' => ['ar' => 'سارة العتيبي', 'en' => 'Sara Al-Otaibi'],
                'position' => ['ar' => 'محامية ومستشارة قانوني', 'en' => 'Lawyer & Legal Consultant'],
                'photo' => 'team_member_5_female_attorney_2_1773656102334.png',
                'sort_order' => 5,
            ],
            [
                'name' => ['ar' => 'فهد المالكي', 'en' => 'Fahad Al-Malki'],
                'position' => ['ar' => 'مستشار أنظمة وامتثال', 'en' => 'Regulatory & Compliance Consultant'],
                'photo' => 'team_member_6_male_attorney_3_1773656160584.png',
                'sort_order' => 6,
            ],
        ];

        foreach ($members as $memberData) {
            $member = TeamMember::create([
                'name' => $memberData['name'],
                'position' => $memberData['position'],
                'sort_order' => $memberData['sort_order'],
                'is_active' => true,
            ]);

            $photoPath = storage_path('app/public/tmp/' . $memberData['photo']);
            $sourcePath = 'C:\\Users\\Lenovo\\.gemini\\antigravity\\brain\\6b45fb47-9599-4576-9212-ccfc1f53be61\\' . $memberData['photo'];

            if (File::exists($sourcePath)) {
                $member->addMedia($sourcePath)
                    ->preservingOriginal()
                    ->toMediaCollection('team_photos');
            }
        }
    }
}
