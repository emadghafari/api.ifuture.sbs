<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            ['key' => 'site_name', 'locale' => null, 'value' => 'iFuture Hub'],
            ['key' => 'site_logo', 'locale' => null, 'value' => null], // For image upload path

            // Hero Section 
            ['key' => 'hero_title_1', 'locale' => 'ar', 'value' => 'نطور عالمك.'],
            ['key' => 'hero_title_2', 'locale' => 'ar', 'value' => 'بابتكار لا يحدّه سقف.'],
            ['key' => 'hero_subtitle', 'locale' => 'ar', 'value' => 'نقدم حلولاً برمجية مخصصة للشركات الطموحة والمشاريع الناشئة، نبني أنظمة متكاملة تدفع بأعمالك نحو الريادة الرقمية.'],
            ['key' => 'hero_button', 'locale' => 'ar', 'value' => 'ابدأ مشروعك'],

            ['key' => 'hero_title_1', 'locale' => 'he', 'value' => 'מפתחים את העולם שלך.'],
            ['key' => 'hero_title_2', 'locale' => 'he', 'value' => 'עם חדשנות ללא גבולות.'],
            ['key' => 'hero_subtitle', 'locale' => 'he', 'value' => 'אנו מספקים פתרונות תוכנה מותאמים אישית לחברות שאפתניות וסטארט-אפים, בונים מערכות משולבות הדוחפות את העסק שלך למנהיגות דיגיטלית.'],
            ['key' => 'hero_button', 'locale' => 'he', 'value' => 'התחל פרויקט'],

            ['key' => 'hero_title_1', 'locale' => 'en', 'value' => 'Moving Your World.'],
            ['key' => 'hero_title_2', 'locale' => 'en', 'value' => 'With limitless innovation.'],
            ['key' => 'hero_subtitle', 'locale' => 'en', 'value' => 'We deliver custom software solutions for ambitious enterprises and dynamic startups. Building integrated systems that drive digital leadership.'],
            ['key' => 'hero_button', 'locale' => 'en', 'value' => 'Start Your Project'],

            // Hero Stats
            ['key' => 'stat_1_val', 'locale' => 'ar', 'value' => '99.9%'],
            ['key' => 'stat_1_lbl', 'locale' => 'ar', 'value' => 'استقرار الأنظمة'],
            ['key' => 'stat_2_val', 'locale' => 'ar', 'value' => 'متكامل'],
            ['key' => 'stat_2_lbl', 'locale' => 'ar', 'value' => 'دعم فني وتطوير'],
            ['key' => 'stat_3_val', 'locale' => 'ar', 'value' => 'للمشاريع'],
            ['key' => 'stat_3_lbl', 'locale' => 'ar', 'value' => 'حلول قابلة للتوسع'],

            ['key' => 'stat_1_val', 'locale' => 'he', 'value' => '99.9%'],
            ['key' => 'stat_1_lbl', 'locale' => 'he', 'value' => 'יציבות מערכות'],
            ['key' => 'stat_2_val', 'locale' => 'he', 'value' => 'משולב'],
            ['key' => 'stat_2_lbl', 'locale' => 'he', 'value' => 'תמיכה ופיתוח'],
            ['key' => 'stat_3_val', 'locale' => 'he', 'value' => 'לפרויקטים'],
            ['key' => 'stat_3_lbl', 'locale' => 'he', 'value' => 'פתרונות גמישים'],

            ['key' => 'stat_1_val', 'locale' => 'en', 'value' => '99.9%'],
            ['key' => 'stat_1_lbl', 'locale' => 'en', 'value' => 'System Uptime'],
            ['key' => 'stat_2_val', 'locale' => 'en', 'value' => 'Full-Cycle'],
            ['key' => 'stat_2_lbl', 'locale' => 'en', 'value' => 'Development & Support'],
            ['key' => 'stat_3_val', 'locale' => 'en', 'value' => 'Scalable'],
            ['key' => 'stat_3_lbl', 'locale' => 'en', 'value' => 'Enterprise Solutions'],

            // About Section
            ['key' => 'about_tagline', 'locale' => 'ar', 'value' => 'تطوير برمجي متقدم'],
            ['key' => 'about_title_1', 'locale' => 'ar', 'value' => 'ما وراء الحدود.'],
            ['key' => 'about_title_2', 'locale' => 'ar', 'value' => 'نحو المستقبل.'],
            ['key' => 'about_description', 'locale' => 'ar', 'value' => 'نحن لسنا مجرد مزود للأنظمة الجاهزة، بل شريك تقني يطور برمجيات متخصصة (Custom Software) تلبي احتياجاتك المعقدة. من برمجة المشاريع الناشئة (Startups) إلى بناء الأنظمة المؤسسية المترابطة بالكامل لتسهيل سير الأعمال.'],
            ['key' => 'about_cta', 'locale' => 'ar', 'value' => 'ناقش فكرتك'],

            ['key' => 'about_tagline', 'locale' => 'he', 'value' => 'פיתוח תוכנה מתקדם'],
            ['key' => 'about_title_1', 'locale' => 'he', 'value' => 'מעבר לגבולות.'],
            ['key' => 'about_title_2', 'locale' => 'he', 'value' => 'אל העתיד.'],
            ['key' => 'about_description', 'locale' => 'he', 'value' => 'אנו לא רק ספק של מערכות מוכנות, אלא שותף טכנולוגי המפתח תוכנה מותאמת אישית לצרכים המורכבים שלך. מקידוד סטארט-אפים ועד בניית מערכות ארגוניות מקושרות היטב.'],
            ['key' => 'about_cta', 'locale' => 'he', 'value' => 'דבר איתנו'],

            ['key' => 'about_tagline', 'locale' => 'en', 'value' => 'Advanced Engineering'],
            ['key' => 'about_title_1', 'locale' => 'en', 'value' => 'Beyond boundaries.'],
            ['key' => 'about_title_2', 'locale' => 'en', 'value' => 'Into the future.'],
            ['key' => 'about_description', 'locale' => 'en', 'value' => 'We are more than a SaaS provider. We are your technical partner, engineering custom software to solve complex challenges. From launching dynamic MVPs for startups to architecting interconnected enterprise ecosystems.'],
            ['key' => 'about_cta', 'locale' => 'en', 'value' => 'Discuss Your Idea'],

            // Team Section
            ['key' => 'team_title', 'locale' => 'ar', 'value' => 'عقول هندسية'],
            ['key' => 'team_subtitle', 'locale' => 'ar', 'value' => 'فريق من المطورين والمبتكرين لبناء تطورك الرقمي.'],

            ['key' => 'team_title', 'locale' => 'he', 'value' => 'מוחות הנדסיים'],
            ['key' => 'team_subtitle', 'locale' => 'he', 'value' => 'צוות מפתחים ומהנדסים לבניית האבולוציה הדיגיטלית שלך.'],

            ['key' => 'team_title', 'locale' => 'en', 'value' => 'Engineering Minds'],
            ['key' => 'team_subtitle', 'locale' => 'en', 'value' => 'Backed by technical experts to power your digital evolution.'],

            // Company Contact Details
            ['key' => 'company_email', 'locale' => null, 'value' => 'info@ifuture.sbs'],
            ['key' => 'company_phone', 'locale' => null, 'value' => '+972 50 123 4567'],

            ['key' => 'company_address', 'locale' => 'ar', 'value' => 'شارع التكنولوجيا، المنطقة الرقمية، المبنى ب'],
            ['key' => 'company_address', 'locale' => 'he', 'value' => 'רחוב הטכנולוגיה, אזור דיגיטלי, בניין ב'],
            ['key' => 'company_address', 'locale' => 'en', 'value' => 'Technology St, Digital District, Building B'],
        ];

        foreach ($settings as $s) {
            Setting::updateOrCreate(
            ['key' => $s['key'], 'locale' => $s['locale']],
            ['value' => $s['value']]
            );
        }
    }
}
