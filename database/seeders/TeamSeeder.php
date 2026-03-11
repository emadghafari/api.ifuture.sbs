<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            [
                'type' => 'founder',
                'translations' => [
                    'ar' => ['name' => 'المؤسس', 'role' => 'مؤسس ورئيس تنفيذي', 'bio' => 'رؤية مستقبلية نحو التحول الرقمي.'],
                    'he' => ['name' => 'מייסד', 'role' => 'מייסד ומנכ"ל', 'bio' => 'חזון לעתיד לקראת טרנספורמציה דיגיטלית.'],
                    'en' => ['name' => 'Founder', 'role' => 'Founder & CEO', 'bio' => 'A future vision towards digital transformation.'],
                ]
            ],
            [
                'type' => 'developer',
                'translations' => [
                    'ar' => ['name' => 'المطور', 'role' => 'مطور برمجيات أول', 'bio' => 'بناء حلول برمجية قوية وفعالة.'],
                    'he' => ['name' => 'מפתח', 'role' => 'מפתח תוכנה בכיר', 'bio' => 'בניית פתרונות תוכנה חזקים ויעילים.'],
                    'en' => ['name' => 'Developer', 'role' => 'Senior Software Developer', 'bio' => 'Building robust and efficient software solutions.'],
                ]
            ],
            [
                'type' => 'manager',
                'translations' => [
                    'ar' => ['name' => 'المدير', 'role' => 'مدير وحدة الأعمال', 'bio' => 'التأكد من التميز في تقديم الخدمات.'],
                    'he' => ['name' => 'מנהל', 'role' => 'מנהל יחידה עסקית', 'bio' => 'הבטחת מצוינות במתן שירותים.'],
                    'en' => ['name' => 'Manager', 'role' => 'Business Unit Manager', 'bio' => 'Ensuring excellence in service delivery.'],
                ]
            ],
        ];

        foreach ($members as $mData) {
            $member = TeamMember::create([
                'type' => $mData['type'],
                'sort_order' => 0,
            ]);

            foreach ($mData['translations'] as $locale => $trans) {
                $member->translations()->create(array_merge($trans, ['locale' => $locale]));
            }
        }
    }
}
