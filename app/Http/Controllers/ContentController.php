<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Faq;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function getPage($slug)
    {
        if (Page::count() === 0) {
            $this->seedPages();
        }
        $page = Page::where('slug', $slug)->first();
        if (!$page) {
            return response()->json(['message' => 'Page not found'], 404);
        }
        return response()->json($page);
    }

    public function getFaqs()
    {
        if (Faq::count() === 0) {
            $this->seedFaqs();
        }
        return response()->json(Faq::orderBy('sort_order')->get());
    }

    // ─── Hero Slides ───
    public function getHeroSlides()
    {
        return response()->json([
            ['src' => '/vid/WhatsApp Video 2026-03-25 at 11.40.41 PM.mp4', 'alt' => 'Kemet Video', 'type' => 'video'],
            ['src' => '/vid/WhatsApp Video 2026-03-25 at 11.39.11 PM.mp4', 'alt' => 'Egypt Video 2', 'type' => 'video'],
        ]);
    }

    // ─── Navbar Items ───
    public function getNavItems()
    {
        return response()->json([
            ['name' => 'Homepage', 'link' => '/'],
            ['name' => 'Souvenir Shop 🛍️', 'link' => '/shop'],
            ['name' => 'AI Planner ✨', 'link' => '/ai-planner'],
            ['name' => 'Activities', 'link' => '/activities'],
            [
                'name' => 'Destinations',
                'dropdown' => [
                    ['name' => 'Hotels', 'link' => '/hotels'],
                    ['name' => 'Restaurants', 'link' => '/restaurants'],
                    ['name' => 'Transportation', 'link' => '/transportation'],
                    ['name' => 'Events', 'link' => '/events'],
                    ['name' => 'Safari', 'link' => '/safari'],
                    ['name' => 'Museums', 'link' => '/museums'],
                    ['name' => 'Bazaars', 'link' => '/bazaars'],
                ],
            ],
            ['name' => 'Support', 'link' => '/support'],
        ]);
    }

    // ─── Why Choose Us ───
    public function getWhyChooseUs()
    {
        return response()->json([
            ['id' => 1, 'src' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=100&h=100&fit=crop', 'alt' => 'WhyUs1', 'title' => 'Ultimate flexibility', 'description' => "You're in control, with free cancellation and payment options to satisfy any plan or budget."],
            ['id' => 2, 'src' => 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=100&h=100&fit=crop', 'alt' => 'WhyUs2', 'title' => 'Memorable experiences', 'description' => "Browse and book tours and activities so incredible, you'll want to tell your friends."],
            ['id' => 3, 'src' => 'https://images.unsplash.com/photo-1522199755839-a2bacb67c546?w=100&h=100&fit=crop', 'alt' => 'WhyUs3', 'title' => 'Quality at our core', 'description' => 'High-quality standards. Millions of reviews. A tourz company.'],
            ['id' => 4, 'src' => 'https://images.unsplash.com/photo-1521791136064-7986c2920216?w=100&h=100&fit=crop', 'alt' => 'WhyUs4', 'title' => 'Award-winning support', 'description' => "New price? New plan? No problem. We're here to help, 24/7."],
        ]);
    }

    // ─── Footer Data ───
    public function getFooterData()
    {
        return response()->json([
            'payImages' => [
                ['id' => 1, 'src' => '/images/visa.png', 'alt' => 'visa'],
                ['id' => 2, 'src' => '/images/mastercard.png', 'alt' => 'mastercard'],
                ['id' => 3, 'src' => '/images/applepay.png', 'alt' => 'applepay'],
                ['id' => 4, 'src' => '/images/discover.png', 'alt' => 'discover'],
                ['id' => 5, 'src' => '/images/paypal.png', 'alt' => 'paypal'],
                ['id' => 6, 'src' => '/images/amex.png', 'alt' => 'amex'],
            ],
            'contact' => [
                'address' => '328 Queensberry Street, Cairo, Egypt',
                'email' => 'nasere489@gmail.com',
                'social' => [
                    ['type' => 'facebook', 'url' => 'https://www.facebook.com/share/14UL6j576Qw/'],
                    ['type' => 'instagram', 'url' => 'https://www.instagram.com/kemet2540?igsh=MXdjZmxtOXQ4c3hnNQ=='],
                    ['type' => 'tiktok', 'url' => 'https://www.tiktok.com/@egypt123456798?_r=1&_t=ZS-93mv12pHBFS'],
                    ['type' => 'whatsapp', 'url' => 'https://wa.me/201060401644'],
                ],
            ],
        ]);
    }

    // ─── Attractions Data ───
    public function getAttractions()
    {
        return response()->json($this->attractionsData());
    }

    public function getAttraction($slug)
    {
        $data = $this->attractionsData();
        if (!isset($data[$slug])) {
            return response()->json(['message' => 'Attraction not found'], 404);
        }
        return response()->json($data[$slug]);
    }

    private function attractionsData()
    {
        return [
            'giza' => [
                'slug' => 'giza', 'name' => 'Pyramids of Giza', 'nameAr' => 'أهرامات الجيزة',
                'era' => 'Pharaonic', 'eraAr' => 'حضارة الفراعنة',
                'location' => 'Giza, Cairo', 'governorate' => 'Giza',
                'rating' => 4.9, 'reviews' => 48320,
                'description' => 'أحد عجائب الدنيا السبع — الهرم الأكبر وأبو الهول يقفان شامخَين منذ أكثر من 4500 عام',
                'longDescription' => 'الأهرامات الثلاثة الكبرى (خوفو وخفرع ومنقرع) وأبو الهول العظيم تُشكّل واحدة من أعظم الإنجازات البشرية على مر التاريخ. بُنيت كمقابر ملكية لفراعنة الأسرة الرابعة، ولا تزال تمثل رمزًا لحكمة وقوة الحضارة المصرية القديمة.',
                'image' => 'https://images.unsplash.com/photo-1539768942893-daf53e448371?w=1600&q=90',
                'gallery' => ['https://images.unsplash.com/photo-1568322445389-f64ac2515020?w=800&q=80','https://images.unsplash.com/photo-1590150284286-5d5b26a5c3f7?w=800&q=80','https://images.unsplash.com/photo-1553913861-c0fddf2619ee?w=800&q=80'],
                'ticketPrices' => [
                    ['type' => 'مصري', 'price' => 40, 'currency' => 'EGP', 'desc' => 'دخول الحرم والمنطقة الأثرية'],
                    ['type' => 'أجنبي - عادي', 'price' => 17, 'currency' => 'USD', 'desc' => 'دخول الحرم والمنطقة الأثرية'],
                    ['type' => 'أجنبي - طالب', 'price' => 9, 'currency' => 'USD', 'desc' => 'بطاقة طالب سارية مطلوبة'],
                    ['type' => 'دخل الهرم الأكبر', 'price' => 25, 'currency' => 'USD', 'desc' => 'دخول داخل هرم خوفو (محدود)'],
                ],
                'openingHours' => '8:00 ص — 5:00 م (شتاء) | 7:00 ص — 7:00 م (صيف)',
                'bestTime' => 'أكتوبر — أبريل (طقس معتدل)', 'duration' => '3 — 5 ساعات',
                'highlights' => ['هرم خوفو','هرم خفرع','هرم منقرع','أبو الهول العظيم','جرف الملكات','معبد الوادي'],
                'tips' => ['احجز مبكرًا في الشتاء','ارتدِ نظارة شمسية وقبعة','تجنّب رواد الجملة بدون اتفاق مسبق'],
            ],
            'abu-simbel' => [
                'slug' => 'abu-simbel', 'name' => 'Abu Simbel', 'nameAr' => 'أبو سمبل',
                'era' => 'Pharaonic', 'eraAr' => 'حضارة الفراعنة',
                'location' => 'Aswan, Upper Egypt', 'governorate' => 'Aswan',
                'rating' => 4.9, 'reviews' => 21500,
                'description' => 'المعبد العظيم لرمسيس الثاني — نُقل بالكامل حجرًا حجرًا لإنقاذه من مياه بحيرة ناصر',
                'longDescription' => 'نُحت معبدا أبو سمبل في الصخر الحي إبان حكم رمسيس الثاني الذي دام 66 عامًا في القرن الثالث عشر قبل الميلاد.',
                'image' => 'https://images.unsplash.com/photo-1553913861-c0fddf2619ee?w=1600&q=90',
                'gallery' => ['https://images.unsplash.com/photo-1568322445389-f64ac2515020?w=800&q=80'],
                'ticketPrices' => [
                    ['type' => 'مصري', 'price' => 30, 'currency' => 'EGP', 'desc' => 'دخول المعبدين'],
                    ['type' => 'أجنبي - عادي', 'price' => 15, 'currency' => 'USD', 'desc' => 'دخول المعبدين'],
                    ['type' => 'أجنبي - طالب', 'price' => 8, 'currency' => 'USD', 'desc' => 'بطاقة طالب سارية مطلوبة'],
                ],
                'openingHours' => '5:00 ص — 6:00 م يوميًا',
                'bestTime' => 'فبراير 22 ومارس 22 (ظاهرة تعامد الشمس)', 'duration' => '2 — 3 ساعات',
                'highlights' => ['تماثيل رمسيس الأربعة','قدس الأقداس','معبد نفرتاري','ظاهرة تعامد الشمس'],
                'tips' => ['احجز رحلة الطيران من أسوان مبكرًا','اذهب صباحًا لتجنب الحرارة','لا تفوّت عرض الصوت والضوء'],
            ],
            'valley-of-kings' => [
                'slug' => 'valley-of-kings', 'name' => 'Valley of the Kings', 'nameAr' => 'وادي الملوك',
                'era' => 'Pharaonic', 'eraAr' => 'حضارة الفراعنة',
                'location' => 'Luxor, West Bank', 'governorate' => 'Luxor',
                'rating' => 4.8, 'reviews' => 34200,
                'description' => 'مقبرة أسرار الفراعنة — أكثر من 63 مقبرة ملكية محفورة في قلب الجبل',
                'longDescription' => 'وادي الملوك هو المنطقة الأثرية التي دُفن فيها ملوك وأمراء مصر القديمة خلال عهد الدولة الحديثة.',
                'image' => 'https://images.unsplash.com/photo-1568322445389-f64ac2515020?w=1600&q=90',
                'gallery' => ['https://images.unsplash.com/photo-1553913861-c0fddf2619ee?w=800&q=80'],
                'ticketPrices' => [
                    ['type' => 'مصري', 'price' => 30, 'currency' => 'EGP', 'desc' => 'دخول 3 مقابر مشمولة'],
                    ['type' => 'أجنبي - عادي', 'price' => 14, 'currency' => 'USD', 'desc' => 'دخول 3 مقابر مشمولة'],
                    ['type' => 'مقبرة توت عنخ آمون', 'price' => 20, 'currency' => 'USD', 'desc' => 'تذكرة منفصلة (إضافية)'],
                ],
                'openingHours' => '6:00 ص — 5:00 م (شتاء) | 6:00 ص — 6:00 م (صيف)',
                'bestTime' => 'نوفمبر — مارس', 'duration' => '3 — 4 ساعات',
                'highlights' => ['مقبرة توت عنخ آمون','مقبرة رمسيس الثالث','مقبرة سيتي الأول','وادي الملكات'],
                'tips' => ['احمل مصباح يدوي','لا تصوّر داخل المقابر (محظور)','ابدأ من أبعد مقبرة وعُد للأمام'],
            ],
            'alexandria' => [
                'slug' => 'alexandria', 'name' => 'Alexandria', 'nameAr' => 'الإسكندرية',
                'era' => 'Greco-Roman', 'eraAr' => 'الحقبة اليونانية الرومانية',
                'location' => 'Alexandria, North Coast', 'governorate' => 'Alexandria',
                'rating' => 4.7, 'reviews' => 29800,
                'description' => 'درة البحر المتوسط — مدينة الإسكندر الأكبر حيث قامت أعظم مكتبة في التاريخ القديم',
                'longDescription' => 'أسسها الإسكندر الأكبر عام 331 قبل الميلاد لتكون عاصمة مملكته.',
                'image' => 'https://images.unsplash.com/photo-1572252009286-268acec5ca0a?w=1600&q=90',
                'gallery' => [],
                'ticketPrices' => [
                    ['type' => 'مكتبة الإسكندرية - مصري', 'price' => 10, 'currency' => 'EGP', 'desc' => 'دخول المكتبة والمتاحف'],
                    ['type' => 'مكتبة الإسكندرية - أجنبي', 'price' => 7, 'currency' => 'USD', 'desc' => 'دخول المكتبة والمتاحف'],
                    ['type' => 'قلعة قايتباي - أجنبي', 'price' => 5, 'currency' => 'USD', 'desc' => 'دخول القلعة العثمانية'],
                ],
                'openingHours' => '9:00 ص — 7:00 م', 'bestTime' => 'مارس — مايو، سبتمبر — نوفمبر', 'duration' => 'يوم كامل أو أكثر',
                'highlights' => ['مكتبة الإسكندرية','قلعة قايتباي','كوم الشقافة','المسرح الروماني'],
                'tips' => ['استخدم الترام للتنقل','جرّب السمك الطازج في أبو قير'],
            ],
            'coptic-cairo' => [
                'slug' => 'coptic-cairo', 'name' => 'Coptic Cairo', 'nameAr' => 'الحي القبطي',
                'era' => 'Coptic', 'eraAr' => 'مصر القبطية',
                'location' => 'Old Cairo, Cairo', 'governorate' => 'Cairo',
                'rating' => 4.7, 'reviews' => 15600,
                'description' => 'أقدم أحياء مصر — حيث ترقد كنيسة المعلقة ودير أبو سرجة وكنس بن عزرا',
                'longDescription' => 'الحي القبطي بالقاهرة القديمة يضم أقدم الكنائس المسيحية في العالم.',
                'image' => 'https://images.unsplash.com/photo-1578301978693-85fa9c0320b9?w=1600&q=90',
                'gallery' => [],
                'ticketPrices' => [
                    ['type' => 'دخل المنطقة', 'price' => 0, 'currency' => 'EGP', 'desc' => 'الدخول مجاني'],
                    ['type' => 'المتحف القبطي - مصري', 'price' => 10, 'currency' => 'EGP', 'desc' => 'دخول المتحف'],
                    ['type' => 'المتحف القبطي - أجنبي', 'price' => 6, 'currency' => 'USD', 'desc' => 'دخول المتحف'],
                ],
                'openingHours' => '9:00 ص — 5:00 م يوميًا', 'bestTime' => 'طوال العام', 'duration' => '2 — 3 ساعات',
                'highlights' => ['كنيسة المعلقة','دير أبو سرجة','كنيس بن عزرا','المتحف القبطي'],
                'tips' => ['ارتدِ ملابس محتشمة','الدخول مجاني معظم الكنائس'],
            ],
            'saint-catherine' => [
                'slug' => 'saint-catherine', 'name' => 'Saint Catherine Monastery', 'nameAr' => 'دير سانت كاترين',
                'era' => 'Coptic', 'eraAr' => 'مصر القبطية',
                'location' => 'South Sinai', 'governorate' => 'South Sinai',
                'rating' => 4.9, 'reviews' => 18300,
                'description' => 'أقدم دير مسيحي في العالم لا يزال قائمًا — يرقد عند سفح جبل موسى',
                'longDescription' => 'بُني الدير في القرن السادس الميلادي بأمر من الإمبراطور جستنيان.',
                'image' => 'https://images.unsplash.com/photo-1547036967-23d11aacaee0?w=1600&q=90',
                'gallery' => [],
                'ticketPrices' => [
                    ['type' => 'دخل الدير', 'price' => 0, 'currency' => 'USD', 'desc' => 'الدخول مجاني'],
                    ['type' => 'جبل موسى (مع مرشد)', 'price' => 25, 'currency' => 'USD', 'desc' => 'رحلة الصعود مع مرشد'],
                ],
                'openingHours' => '9:00 ص — 12:00 ظ', 'bestTime' => 'مارس — مايو | سبتمبر — نوفمبر', 'duration' => 'يوم كامل',
                'highlights' => ['الدير العريق','جبل موسى','الشجرة المقدسة','مكتبة المخطوطات'],
                'tips' => ['اصعد جبل موسى في الساعة 2 صباحًا لتشاهد الشروق','احمل بطانية'],
            ],
            'al-azhar' => [
                'slug' => 'al-azhar', 'name' => 'Al-Azhar Mosque', 'nameAr' => 'الجامع الأزهر',
                'era' => 'Islamic', 'eraAr' => 'مصر الإسلامية',
                'location' => 'Islamic Cairo', 'governorate' => 'Cairo',
                'rating' => 4.8, 'reviews' => 22100,
                'description' => 'أقدم جامعة في العالم — أُسس عام 970 م',
                'longDescription' => 'أسّسه جوهر الصقلي قائد الجيش الفاطمي عام 971 م.',
                'image' => 'https://images.unsplash.com/photo-1572252009286-268acec5ca0a?w=1600&q=90',
                'gallery' => [],
                'ticketPrices' => [
                    ['type' => 'دخل المسجد', 'price' => 0, 'currency' => 'EGP', 'desc' => 'الدخول مجاني'],
                    ['type' => 'مع مرشد سياحي', 'price' => 10, 'currency' => 'USD', 'desc' => 'جولة إرشادية'],
                ],
                'openingHours' => '9:00 ص — 11:00 م', 'bestTime' => 'طوال العام — رمضان تجربة فريدة', 'duration' => '1 — 2 ساعة',
                'highlights' => ['المئذنتان التاريخيتان','صحن الأروقة','مكتبة الأزهر','الجامعة العريقة'],
                'tips' => ['ارتدِ ملابس محتشمة','اذهب قبل صلاة الجمعة بساعة'],
            ],
            'cairo-citadel' => [
                'slug' => 'cairo-citadel', 'name' => 'Cairo Citadel', 'nameAr' => 'قلعة صلاح الدين',
                'era' => 'Islamic', 'eraAr' => 'مصر الإسلامية',
                'location' => 'Salah Salem, Cairo', 'governorate' => 'Cairo',
                'rating' => 4.7, 'reviews' => 31200,
                'description' => 'حصن صلاح الدين الأيوبي الشامخ',
                'longDescription' => 'بدأ بناء القلعة صلاح الدين الأيوبي عام 1176 م.',
                'image' => 'https://images.unsplash.com/photo-1572252009286-268acec5ca0a?w=1600&q=90',
                'gallery' => [],
                'ticketPrices' => [
                    ['type' => 'مصري', 'price' => 20, 'currency' => 'EGP', 'desc' => 'دخول القلعة والمتاحف'],
                    ['type' => 'أجنبي - عادي', 'price' => 10, 'currency' => 'USD', 'desc' => 'دخول القلعة والمتاحف'],
                    ['type' => 'أجنبي - طالب', 'price' => 5, 'currency' => 'USD', 'desc' => 'بطاقة طالب سارية مطلوبة'],
                ],
                'openingHours' => '8:00 ص — 5:00 م يوميًا', 'bestTime' => 'طوال العام', 'duration' => '2 — 3 ساعات',
                'highlights' => ['جامع محمد علي','متحف الشرطة','متحف النظام القديم','بئر يوسف'],
                'tips' => ['اصعد للمئذنة لمشهد بانورامي للقاهرة'],
            ],
            'red-sea' => [
                'slug' => 'red-sea', 'name' => 'Red Sea', 'nameAr' => 'البحر الأحمر',
                'era' => 'Modern', 'eraAr' => 'مصر الحديثة',
                'location' => 'Hurghada / Sharm El Sheikh', 'governorate' => 'Red Sea',
                'rating' => 4.8, 'reviews' => 56400,
                'description' => 'أحد أجمل بحار العالم — شعاب مرجانية بألوان لا توصف',
                'longDescription' => 'يُعدّ البحر الأحمر موطنًا لبعض أغنى النظم البيئية البحرية في العالم.',
                'image' => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=1600&q=90',
                'gallery' => [],
                'ticketPrices' => [
                    ['type' => 'رحلة سنوركل نصف يوم', 'price' => 25, 'currency' => 'USD', 'desc' => 'تشمل المعدات والمرشد'],
                    ['type' => 'غوص للمبتدئين', 'price' => 50, 'currency' => 'USD', 'desc' => 'دورة تمهيدية + غطسة واحدة'],
                    ['type' => 'رحلة قارب يوم كامل', 'price' => 45, 'currency' => 'USD', 'desc' => 'تشمل الغداء وعدة مواقع'],
                ],
                'openingHours' => 'طوال اليوم — الرحلات من 8:00 ص', 'bestTime' => 'مارس — مايو | سبتمبر — نوفمبر', 'duration' => 'نصف يوم — عدة أيام',
                'highlights' => ['شعاب المرجان','الغوص والسنوركل','الدولفين','رحلات الكيت سيرف'],
                'tips' => ['احمل كريم واقي الشمس','احجز رحلة الغوص مبكرًا'],
            ],
            'north-coast' => [
                'slug' => 'north-coast', 'name' => 'North Coast', 'nameAr' => 'الساحل الشمالي',
                'era' => 'Modern', 'eraAr' => 'مصر الحديثة',
                'location' => 'Marsa Matrouh Governorate', 'governorate' => 'Matrouh',
                'rating' => 4.6, 'reviews' => 19800,
                'description' => 'شواطئ بمياه فيروزية تنافس جزر البحر الأبيض',
                'longDescription' => 'يمتد الساحل الشمالي لمصر على مسافة 1000 كيلومتر.',
                'image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1600&q=90',
                'gallery' => [],
                'ticketPrices' => [
                    ['type' => 'دخول المنتجع', 'price' => 30, 'currency' => 'USD', 'desc' => 'يشمل المظلة والكرسي'],
                    ['type' => 'رحلة قارب', 'price' => 15, 'currency' => 'USD', 'desc' => 'جولة بحرية ساعة ونصف'],
                ],
                'openingHours' => 'طوال اليوم (صيف)', 'bestTime' => 'يونيو — سبتمبر', 'duration' => 'عدة أيام',
                'highlights' => ['شاطئ مرسى مطروح','واحة سيوة','بحيرة أوزو','أجيبة'],
                'tips' => ['احجز فندقًا مبكرًا','الطريق الساحلي جميل'],
            ],
            'new-capital' => [
                'slug' => 'new-capital', 'name' => 'New Administrative Capital', 'nameAr' => 'العاصمة الإدارية الجديدة',
                'era' => 'Modern', 'eraAr' => 'مصر الحديثة',
                'location' => 'East Cairo', 'governorate' => 'Cairo',
                'rating' => 4.5, 'reviews' => 8900,
                'description' => 'المدينة التي تُبنى الآن — مشروع القرن المصري',
                'longDescription' => 'العاصمة الإدارية الجديدة هي مدينة عملاقة تُنشأ شرق القاهرة.',
                'image' => 'https://images.unsplash.com/photo-1600868205423-1c3906a4b162?w=1600&q=90',
                'gallery' => [],
                'ticketPrices' => [
                    ['type' => 'جولة سياحية منظمة', 'price' => 20, 'currency' => 'USD', 'desc' => 'جولة بالحافلة مع مرشد'],
                    ['type' => 'مسجد مصر الكبير', 'price' => 0, 'currency' => 'EGP', 'desc' => 'الدخول مجاني'],
                ],
                'openingHours' => 'يومي', 'bestTime' => 'طوال العام', 'duration' => 'نصف يوم',
                'highlights' => ['برج مصر','المسجد الكبير','الكاتدرائية','الحي الحكومي'],
                'tips' => ['احجز مع شركة سياحية للوصول السهل'],
            ],
            'hanging-church' => [
                'slug' => 'hanging-church', 'name' => 'The Hanging Church', 'nameAr' => 'كنيسة المعلقة',
                'era' => 'Coptic', 'eraAr' => 'مصر القبطية',
                'location' => 'Old Cairo, Cairo', 'governorate' => 'Cairo',
                'rating' => 4.8, 'reviews' => 12400,
                'description' => 'سيدة كنائس مصر — معلّقة فوق برجَيْن رومانيَّين',
                'longDescription' => 'كنيسة السيدة العذراء المعلقة بُنيت فوق بوابة قصر بابليون الجنوبية.',
                'image' => 'https://images.unsplash.com/photo-1578301978693-85fa9c0320b9?w=1600&q=90',
                'gallery' => [],
                'ticketPrices' => [
                    ['type' => 'دخل الكنيسة', 'price' => 0, 'currency' => 'EGP', 'desc' => 'الدخول مجاني'],
                ],
                'openingHours' => '9:00 ص — 5:00 م', 'bestTime' => 'طوال العام', 'duration' => '1 — 2 ساعة',
                'highlights' => ['الأيقونات البيزنطية','مقصورة الأمير تادرس','جدارية العذراء','المنبر الرخامي'],
                'tips' => ['تأتي مع باقي مزارات القبطية في نفس اليوم'],
            ],
            'kom-el-dikka' => [
                'slug' => 'kom-el-dikka', 'name' => 'Kom El Dikka', 'nameAr' => 'كوم الدكة',
                'era' => 'Greco-Roman', 'eraAr' => 'الحقبة اليونانية الرومانية',
                'location' => 'Alexandria', 'governorate' => 'Alexandria',
                'rating' => 4.5, 'reviews' => 9800,
                'description' => 'المسرح الروماني الوحيد في مصر',
                'longDescription' => 'اكتُشف بالصدفة عام 1960.',
                'image' => 'https://images.unsplash.com/photo-1572252009286-268acec5ca0a?w=1600&q=90',
                'gallery' => [],
                'ticketPrices' => [
                    ['type' => 'مصري', 'price' => 10, 'currency' => 'EGP', 'desc' => 'دخول الموقع'],
                    ['type' => 'أجنبي', 'price' => 6, 'currency' => 'USD', 'desc' => 'دخول الموقع'],
                    ['type' => 'أجنبي - طالب', 'price' => 3, 'currency' => 'USD', 'desc' => 'نصف السعر'],
                ],
                'openingHours' => '9:00 ص — 5:00 م', 'bestTime' => 'أكتوبر — أبريل', 'duration' => '1 — 2 ساعة',
                'highlights' => ['المسرح الروماني','حمامات رومانية','فسيفساء رائعة','مراكز تجارية رومانية'],
                'tips' => ['يقع في قلب الإسكندرية سهل الوصول'],
            ],
        ];
    }

    private function seedPages()
    {
        $pages = [
            ['slug' => 'about', 'title' => 'About Kemet', 'content' => '<h2>Welcome to Kemet</h2><p>Kemet is your gateway to discovering the wonders of Egypt.</p>'],
            ['slug' => 'privacy', 'title' => 'Privacy Policy', 'content' => '<h2>Privacy Policy</h2><p>Last updated: April 2026</p>'],
            ['slug' => 'terms', 'title' => 'Terms of Service', 'content' => '<h2>Terms of Service</h2><p>By using Kemet, you agree to these terms.</p>'],
        ];
        foreach ($pages as $page) { Page::create($page); }
    }

    private function seedFaqs()
    {
        $faqs = [
            ['question' => 'How do I book a hotel or tour?', 'answer' => 'Simply browse our listings, select your preferred option, choose your dates and guests, then click "Book Now".', 'sort_order' => 1],
            ['question' => 'What payment methods do you accept?', 'answer' => 'We accept major credit cards (Visa, Mastercard, American Express), PayPal, and various local payment methods.', 'sort_order' => 2],
            ['question' => 'Can I cancel or modify my booking?', 'answer' => 'Yes! Most bookings can be cancelled or modified for free up to 48 hours before the scheduled date.', 'sort_order' => 3],
            ['question' => 'Do I need a visa to visit Egypt?', 'answer' => 'Most nationalities can obtain a visa on arrival or an e-visa before traveling.', 'sort_order' => 4],
            ['question' => 'What is the best time to visit Egypt?', 'answer' => 'The best time to visit Egypt is from October to April when temperatures are more moderate.', 'sort_order' => 5],
            ['question' => 'Are tours conducted in English?', 'answer' => 'Yes, all our guided tours are available in English. We also offer tours in Arabic, French, German, and Spanish.', 'sort_order' => 6],
            ['question' => 'Is it safe to travel in Egypt?', 'answer' => 'Egypt is a popular tourist destination with millions of visitors each year.', 'sort_order' => 7],
            ['question' => 'How do I contact customer support?', 'answer' => 'You can reach our 24/7 support team through our website, via email, or through WhatsApp.', 'sort_order' => 8],
        ];
        foreach ($faqs as $faq) { Faq::create($faq); }
    }
}
