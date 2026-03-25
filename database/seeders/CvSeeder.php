<?php

namespace Database\Seeders;

use App\Models\CvSetting;
use App\Models\Education;
use App\Models\Skill;
use App\Models\WorkExperience;
use Illuminate\Database\Seeder;

class CvSeeder extends Seeder
{
    public function run(): void
    {
        // ── Personal info & profile ─────────────────────────────────────────────
        CvSetting::updateOrCreate(['id' => 1], [
            'name'          => 'Jelle Traa',
            'job_title_nl'  => 'PHP Developer',
            'job_title_en'  => 'PHP Developer',
            'dob'           => '29-06-1995',
            'address_line1' => 'Statenkwartier 82',
            'address_line2' => "5235 KL 's-Hertogenbosch",
            'availability'  => '32–36 uur',
            'email'         => 'info@itraa.nl',
            'phone'         => '+31 624842264',
            'linkedin'      => 'https://www.linkedin.com/in/jelletraa/',
            'github'        => 'https://github.com/jtraa',
            'profile_nl'    => 'Met meer dan 7 jaar ervaring in programmeren, gecombineerd met sterke analytische, communicatieve en financiële vaardigheden, ben ik een ideale kandidaat. (Oud-)collega\'s omschrijven mij als gedreven, betrouwbaar, snel lerend en een gewaardeerde teamplayer. Ik blijf mezelf ontwikkelen via video\'s, documentatie, netwerken, boeken en cursussen.',
            'profile_en'    => 'With more than 7 years of programming experience, combined with strong analytical, communicative and financial skills, I am an ideal candidate. Former colleagues describe me as driven, reliable, a fast learner and a valued team player. I continue to develop myself through videos, documentation, networking, books and courses.',
        ]);

        // ── Skills ──────────────────────────────────────────────────────────────
        Skill::truncate();
        $skills = [
            ['category_nl' => 'Besturingssystemen',          'category_en' => 'Operating systems',          'items' => 'Apple | Windows | Linux',                                                   'sort_order' => 1],
            ['category_nl' => 'Markup / stylesheet talen',   'category_en' => 'Markup / stylesheet languages', 'items' => 'HTML | CSS',                                                            'sort_order' => 2],
            ['category_nl' => 'Programmeertalen',            'category_en' => 'Programming languages',      'items' => 'PHP (5.7 – 8.3) | JavaScript | SQL',                                        'sort_order' => 3],
            ['category_nl' => 'Talen',                       'category_en' => 'Languages',                  'items' => 'Nederlands | Engels',                                                       'sort_order' => 4],
            ['category_nl' => 'Library',                     'category_en' => 'Library',                    'items' => 'Vuetify | Tailwind',                                                        'sort_order' => 5],
            ['category_nl' => 'Frameworks',                  'category_en' => 'Frameworks',                 'items' => 'Laravel 6 t/m 11 | VueJS | Livewire',                                       'sort_order' => 6],
            ['category_nl' => 'CMS',                         'category_en' => 'CMS',                        'items' => 'Wordpress | Lightspeed | Shopify | Webflow',                                 'sort_order' => 7],
            ['category_nl' => 'Methodieken',                 'category_en' => 'Methodologies',             'items' => 'Scrum | Agile | MVC | OTAP | Test Driven Development | Object Oriented',      'sort_order' => 8],
            ['category_nl' => 'Tools',                       'category_en' => 'Tools',                      'items' => 'Composer | Gitlab | Git | Docker | XML | REST API\'s',                       'sort_order' => 9],
        ];
        foreach ($skills as $s) {
            Skill::create($s);
        }

        // ── Education ───────────────────────────────────────────────────────────
        Education::truncate();
        $education = [
            [
                'title_nl'    => 'Full Stack Developer',
                'title_en'    => 'Full Stack Developer',
                'institution' => 'CodeGorilla',
                'period'      => '2017 December – 2018 Maart',
                'learned_nl'  => 'Laravel; PHP; JavaScript, HTML, CSS, Agile; Scrum; Object Oriented; MySQL; Relational databases; Front end development; Back end development.',
                'learned_en'  => 'Laravel; PHP; JavaScript, HTML, CSS, Agile; Scrum; Object Oriented; MySQL; Relational databases; Front end development; Back end development.',
                'sort_order'  => 1,
            ],
            [
                'title_nl'    => 'Business IT and Management',
                'title_en'    => 'Business IT and Management',
                'institution' => 'Avans Breda',
                'period'      => '2015 – 2017',
                'learned_nl'  => 'PHP; Projectmanagement; Scrum; E-Commerce; Informatiesystemen.',
                'learned_en'  => 'PHP; Project management; Scrum; E-Commerce; Information systems.',
                'sort_order'  => 2,
            ],
            [
                'title_nl'    => 'Bedrijfsadministrateur Niveau 4',
                'title_en'    => 'Business Administrator Level 4',
                'institution' => 'Koning Willem I College',
                'period'      => '2011 – 2015',
                'learned_nl'  => 'Bedrijfsadministratie; Onderneming starten; Boekhouden.',
                'learned_en'  => 'Business administration; Starting a company; Bookkeeping.',
                'sort_order'  => 3,
            ],
        ];
        foreach ($education as $e) {
            Education::create($e);
        }

        // ── Work experience ─────────────────────────────────────────────────────
        WorkExperience::truncate();
        $experiences = [
            [
                'period'         => 'Juni 2024 – Heden',
                'company'        => 'FaceClock',
                'description_nl' => 'Voor FaceClock werk ik 1 à 2 dagen per week om te helpen bij nieuwe features en bugs op te lossen in hun urenregistratie systeem. Hierbij werk ik met meerdere freelancers samen om het systeem te onderhouden.',
                'description_en' => 'For FaceClock I work 1 to 2 days per week helping with new features and resolving bugs in their time-tracking system. I collaborate with other freelancers to maintain the system.',
                'url'            => 'https://www.faceclock.nl/',
                'tech_stack'     => 'Laravel, Filament, Gitlab, PHP, OOP, Agile',
                'sort_order'     => 1,
            ],
            [
                'period'         => 'Juli 2023 – Heden',
                'company'        => 'BMP Nederland',
                'description_nl' => '1 à 2 dagen in de week werk ik voor BMP Nederland, zij hebben een systeem voor luxe deuren. Dit systeem bestaat uit verschillende modules zoals administratie en offertes. Ik bedenk mee aan oplossingen voor het systeem en implementeer deze oplossingen met Laravel / PHP.',
                'description_en' => '1 to 2 days a week I work for BMP Nederland, which has a system for luxury doors. This system consists of various modules such as administration and quotations. I contribute to solutions and implement them using Laravel / PHP.',
                'url'            => 'https://www.bmpnederland.nl/',
                'tech_stack'     => 'Laravel, Bitbucket, PHP, JavaScript, OOP, Agile',
                'sort_order'     => 2,
            ],
            [
                'period'         => 'Oktober 2023 – Maart 2024',
                'company'        => 'Risk Verzekeringen / Overstappen.nl',
                'description_nl' => 'PHP / Wordpress developer. De werkzaamheden die ik heb verricht bij dit bedrijf is de (html) blocks in de backend maken en die op de requirements van de klant te verbeteren. Daarnaast ook technische oplossingen bedenken voor de backend.',
                'description_en' => 'PHP / WordPress developer. My work included building (HTML) blocks in the backend and improving them to meet client requirements, as well as devising technical solutions for the backend.',
                'url'            => 'https://www.overstappen.nl/',
                'tech_stack'     => 'Wordpress, Bitbucket, PHP, JavaScript, React, Agile',
                'sort_order'     => 3,
            ],
            [
                'period'         => 'Juni 2023 – Juli 2023',
                'company'        => 'ESG / Kettlitz',
                'description_nl' => 'Website en CMS voor ESG Kettlitz. Project in Laravel gebouwd: Een CMS en een website, de website wordt volledig ingeladen door de backend. Gebruiker kan inloggen met Microsoft en daarnaast alle componenten van de website aanpassen en nieuwe componenten toevoegen.',
                'description_en' => 'Website and CMS for ESG Kettlitz. Built in Laravel: a CMS and a website fully driven by the backend. Users can log in with Microsoft and edit all website components or add new ones.',
                'url'            => 'https://www.kettlitz.nl/',
                'tech_stack'     => 'Laravel, Laravel Filament, VueJS, Tailwind, OOP, Gitlab',
                'sort_order'     => 4,
            ],
            [
                'period'         => 'Januari 2022 – Mei 2023',
                'company'        => 'Solera / Nationale Nederlanden Verzekeringen',
                'description_nl' => 'De werkzaamheden omvatten het bouwen van verzekeringsscripts in grote verzekeringssystemen met behulp van PHP. Daarnaast gaf ik consultancy aan medewerkers van Nationale Nederlanden en verwerkte ik Excels in PHP-scripts. Ik overlegde regelmatig met een team van developers en schreef duidelijke code met richtlijnen, bedacht nieuwe functies en droeg bij het documenteren van het werkproces.',
                'description_en' => 'My work included building insurance scripts in large insurance systems using PHP, providing consultancy to Nationale Nederlanden employees, and processing Excel files via PHP scripts. I regularly collaborated with a developer team, wrote clean and documented code, and helped design new features.',
                'url'            => 'https://www.solera.nl/',
                'tech_stack'     => 'Agile; API-Koppelingen; Composer; Gitlab; Docker; XML; Scrum; OOP; MySQL; PHP; Git; MVC; OTAP',
                'sort_order'     => 5,
            ],
            [
                'period'         => 'Maart 2021 – September 2021',
                'company'        => 'De ESG Staffing site',
                'description_nl' => 'Website voor ESG Staffing. Project in Laravel gebouwd, API gebruikt voor de data inladen, mogelijkheid om form in te vullen op de website en de form wordt gemaild naar klant en opgeslagen in database.',
                'description_en' => 'Website for ESG Staffing. Built in Laravel, using an API to load data. Users can fill in a contact form which is emailed to the client and stored in the database.',
                'url'            => 'https://www.staffing-esg.nl/',
                'tech_stack'     => 'Laravel; Agile; Scrum; OOP; MySQL; Relational databases; Front end development',
                'sort_order'     => 6,
            ],
            [
                'period'         => 'Maart 2021 – September 2021',
                'company'        => 'Helpdesk systeem',
                'description_nl' => 'Dit systeem gebouwd in Laravel. Modules als Mailing, CRUD en hiërarchie (admin, helpdeskmedewerker, user) in het systeem gebouwd. Daarnaast ook de mogelijkheid om als Microsoft account in te loggen via een Microsoft Azure API.',
                'description_en' => 'Built in Laravel. Modules including Mailing, CRUD and a role hierarchy (admin, helpdesk agent, user). Also implemented Microsoft account login via the Azure API.',
                'url'            => null,
                'tech_stack'     => 'Laravel; Agile; Scrum; OOP; MySQL; Relational databases',
                'sort_order'     => 7,
            ],
            [
                'period'         => 'Mei 2018 – Januari 2021',
                'company'        => 'Braveboys',
                'description_nl' => 'Full stack developer bij Braveboys.',
                'description_en' => 'Full stack developer at Braveboys.',
                'url'            => null,
                'tech_stack'     => 'Laravel; PHP; Agile; Scrum; OOP; Front end development',
                'sort_order'     => 8,
            ],
        ];
        foreach ($experiences as $exp) {
            WorkExperience::create($exp);
        }
    }
}
