<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'slug' => 'card',
                'url' => 'https://card.ifuture.sbs',
                'translations' => [
                    'ar' => ['title' => 'بطاقة iFuture الذكية', 'description' => 'بطاقة أعمال رقمية متطورة تعتمد على أحدث التقنيات وتتيح لك مشاركة كافة بياناتك المهنية والشخصية بلمسة واحدة. تغنيك عن البطاقات الورقية وتعكس صورة احترافية وحديثة لعملائك.'],
                    'he' => ['title' => 'iFuture Card', 'description' => 'כרטיס ביקור דיגיטלי חכם מבוסס NFC לשתף את כל המידע העסקי שלך בנגיעה אחת. משדרג את התדמית המקצועית שלך ומחליף את כרטיסי הנייר.'],
                    'en' => ['title' => 'iFuture Smart Card', 'description' => 'An advanced digital business card. Share your professional details instantly with a single tap, offering a modern, eco-friendly alternative to traditional paper cards.'],
                ]
            ],
            [
                'slug' => 'kasher',
                'url' => 'https://kasher.ifuture.sbs',
                'translations' => [
                    'ar' => ['title' => 'نظام الكاشير الاحترافي', 'description' => 'نظام نقاط البيع (POS) متكامل يسهل إدارة المبيعات، المخزون، والتقارير المالية بدقة متناهية. مصمم لدعم مختلف المتاجر والمطاعم بواجهة سلسة.'],
                    'he' => ['title' => 'מערכת קופה מקצועית', 'description' => 'מערכת נקודת מכירה (POS) משולבת המקלה על ניהול מכירות, מלאי ודוחות פיננסיים בדיוק רב. מיועדת לתמוך בחנויות ומסעדות שונות.'],
                    'en' => ['title' => 'Professional POS System', 'description' => 'An integrated Point of Sale (POS) system that simplifies sales, inventory, and financial reporting with high precision. Designed for various retail stores and restaurants.'],
                ]
            ],
            [
                'slug' => 'events',
                'url' => 'https://events.ifuture.sbs',
                'translations' => [
                    'ar' => ['title' => 'منصة إدارة الفعاليات', 'description' => 'حل تقني شامل لتنظيم وإدارة الفعاليات والمؤتمرات. يتيح لك نظام حجز التذاكر، تسجيل الحضور، وتتبع البيانات المباشرة لضمان نجاح أي فعالية باحترافية وتفوق.'],
                    'he' => ['title' => 'פלטפורמת ניהול אירועים', 'description' => 'פתרון טכנולוגי מקיף לארגון וניהול אירועים וכנסים. מאפשר מערכת הזמנת כרטיסים ומעקב נתונים חי להבטחת ההצלחה של כל אירוע.'],
                    'en' => ['title' => 'Events Management Platform', 'description' => 'A comprehensive technological solution for organizing and managing events and conferences. Features ticketing, attendance registration, and live tracking for successful event execution.'],
                ]
            ],
            [
                'slug' => 'gym',
                'url' => 'https://gym.ifuture.sbs',
                'translations' => [
                    'ar' => ['title' => 'نظام النوادي الرياضية', 'description' => 'برنامج مخصص لإدارة النوادي الصحية والصالات الرياضية، يتضمن تتبع اشتراكات الأعضاء، إدارة الحصص التدريبية، ونظام مالي متكامل لتحقيق أقصى استفادة.'],
                    'he' => ['title' => 'מערכת ניהול מכוני כושר', 'description' => 'תוכנה המיועדת לניהול מועדוני בריאות וכושר, כוללת מעקב אחר מנויי חברים, שיעורים ומערכת פיננסית.'],
                    'en' => ['title' => 'Gym Management System', 'description' => 'Dedicated software for managing health clubs and gyms. Includes member subscription tracking, class management, and an integrated financial system.'],
                ]
            ],
            [
                'slug' => 'school',
                'url' => 'https://school.ifuture.sbs',
                'translations' => [
                    'ar' => ['title' => 'النظام التعليمي الشامل', 'description' => 'بوابة تفاعلية ذكية تربط بين الإدارة، المعلمين، والطلاب. يوفر أدوات لإدارة الحضور، الجداول الدراسية، والامتحانات بأسلوب عصري يواكب تطلعات التعليم المستقبلية.'],
                    'he' => ['title' => 'המערכת החינוכית המקיפה', 'description' => 'פורטל אינטראקטיבי חכם המחבר בין ההנהלה, המורים והתלמידים. מספק כלים לניהול נוכחות, לוחות זמנים ומבחנים.'],
                    'en' => ['title' => 'Comprehensive EMS', 'description' => 'A smart interactive portal connecting administration, teachers, and students. Provides tools for attendance, scheduling, and exams in a modern educational approach.'],
                ]
            ],
            [
                'slug' => 'crm',
                'url' => 'https://crm.ifuture.sbs',
                'translations' => [
                    'ar' => ['title' => 'نظام علاقات العملاء CRM', 'description' => 'أداة قوية لبناء علاقات مستدامة مع عملائك. تتيح لك تتبع المبيعات، تحليل أداء فريق العمل، وتقديم دعم فني متميز يزيد من ولاء العملاء ونجاح شركتك.'],
                    'he' => ['title' => 'מערכת ניהול קשרי לקוחות CRM', 'description' => 'כלי רב עוצמה לבניית קשרים ברי קיימא עם הלקוחות שלך. מאפשר לך לעקוב אחר מכירות, ולספק תמיכה טכנית מעולה.'],
                    'en' => ['title' => 'Advanced CRM System', 'description' => 'A powerful tool to build sustainable relationships with your clients. Track sales, analyze team performance, and provide outstanding technical support to increase loyalty.'],
                ]
            ],
        ];

        foreach ($products as $pData) {
            $product = Product::create([
                'slug' => $pData['slug'],
                'url' => $pData['url'],
                'status' => true,
                'featured' => true,
            ]);

            foreach ($pData['translations'] as $locale => $trans) {
                $product->translations()->create(array_merge($trans, ['locale' => $locale]));
            }
        }
    }
}
