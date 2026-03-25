<?php

namespace App\Http\Controllers;

use App\Models\CvSetting;
use App\Models\Education;
use App\Models\Skill;
use App\Models\WorkExperience;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Style\Font;

class DownloadController extends Controller
{
    private function getData(): array
    {
        $settings = CvSetting::instance();

        // Build a base64 data-URI so dompdf can embed the image without
        // needing to resolve any file:// or http:// path at render time.
        $photoDataUri = null;
        if ($settings->photo) {
            $absPath = storage_path('app/public/' . $settings->photo);
        } else {
            $absPath = public_path('images/jelle.jpg');
        }
        if (file_exists($absPath)) {
            $mime = mime_content_type($absPath) ?: 'image/jpeg';
            $photoDataUri = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($absPath));
        }

        return [
            'locale'       => App::getLocale(),
            'settings'     => $settings,
            'skills'       => Skill::orderBy('sort_order')->get(),
            'education'    => Education::orderBy('sort_order')->get(),
            'experiences'  => WorkExperience::orderBy('sort_order')->get(),
            'photoDataUri' => $photoDataUri,
        ];
    }

    // ─── PDF ────────────────────────────────────────────────────────────────────

    public function pdf()
    {
        $data = $this->getData();

        $pdf = Pdf::loadView('cv.pdf', $data)
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'defaultFont'          => 'dejavu sans',
                'isRemoteEnabled'      => true,
                'isHtml5ParserEnabled' => true,
                'dpi'                  => 96,
                'margin_top'           => 10,
                'margin_bottom'        => 10,
                'margin_left'          => 10,
                'margin_right'         => 10,
            ]);

        return $pdf->download('cv-jelle-traa.pdf');
    }

    // ─── DOCX ───────────────────────────────────────────────────────────────────

    public function docx()
    {
        $data     = $this->getData();
        $locale   = $data['locale'];
        $settings = $data['settings'];

        $word = new PhpWord();
        $word->setDefaultFontName('Arial');
        $word->setDefaultFontSize(10);

        // Styles
        $word->addTitleStyle(1, ['bold' => true, 'size' => 20, 'color' => '21254a'], ['spaceAfter' => 120]);
        $word->addTitleStyle(2, ['bold' => true, 'size' => 14, 'color' => '21254a'], ['spaceAfter' => 80]);
        $word->addTitleStyle(3, ['bold' => true, 'size' => 11, 'color' => '21254a'], ['spaceAfter' => 40]);

        $section = $word->addSection([
            'marginTop'    => 720,
            'marginBottom' => 720,
            'marginLeft'   => 1080,
            'marginRight'  => 1080,
        ]);

        // Header
        $section->addTitle($settings->name, 1);

        $jobTitle = $locale === 'en' ? $settings->job_title_en : $settings->job_title_nl;
        $section->addText($jobTitle, ['size' => 13, 'color' => '21254a']);
        $section->addTextBreak(1);

        // Contact details
        $section->addTitle(__('cv.dob'), 3);
        $section->addText($settings->dob ?? '');
        $section->addTitle(__('cv.address'), 3);
        $section->addText(($settings->address_line1 ?? '') . ' ' . ($settings->address_line2 ?? ''));
        $section->addTitle(__('cv.availability'), 3);
        $section->addText($settings->availability ?? '');
        $section->addTitle(__('cv.email'), 3);
        $section->addText($settings->email ?? '');
        $section->addTitle(__('cv.phone'), 3);
        $section->addText($settings->phone ?? '');
        $section->addTextBreak(1);

        // Profile
        $section->addTitle(__('cv.profile'), 2);
        $profile = $locale === 'en' ? $settings->profile_en : $settings->profile_nl;
        $section->addText($profile ?? '');
        $section->addTextBreak(1);

        // Skills
        $section->addTitle(__('cv.skills'), 2);
        foreach ($data['skills'] as $skill) {
            $cat = $locale === 'en' ? $skill->category_en : $skill->category_nl;
            $section->addText($cat, ['bold' => true, 'color' => '21254a']);
            $section->addText($skill->items);
            $section->addTextBreak(1);
        }

        // Education
        $section->addTitle(__('cv.education'), 2);
        foreach ($data['education'] as $edu) {
            $title = $locale === 'en' ? $edu->title_en : $edu->title_nl;
            $learned = $locale === 'en' ? $edu->learned_en : $edu->learned_nl;
            $section->addText($title, ['bold' => true, 'color' => '21254a']);
            $section->addText($edu->period . ' | ' . $edu->institution);
            if ($learned) {
                $section->addText(__('cv.learned') . ': ' . $learned);
            }
            $section->addTextBreak(1);
        }

        // Work experience
        $section->addTitle(__('cv.work_experience'), 2);
        foreach ($data['experiences'] as $exp) {
            $desc = $locale === 'en' ? $exp->description_en : $exp->description_nl;
            $section->addText($exp->period, ['bold' => true]);
            if ($exp->company) {
                $section->addText($exp->company, ['italic' => true]);
            }
            if ($desc) {
                $section->addText($desc);
            }
            if ($exp->url) {
                $section->addText($exp->url, ['color' => '21254a', 'underline' => Font::UNDERLINE_SINGLE]);
            }
            if ($exp->tech_stack) {
                $section->addText(__('cv.method') . ': ' . $exp->tech_stack, ['italic' => true]);
            }
            $section->addTextBreak(1);
        }

        // Output
        $objWriter = IOFactory::createWriter($word, 'Word2007');
        $tmpFile   = tempnam(sys_get_temp_dir(), 'cv_') . '.docx';
        $objWriter->save($tmpFile);

        return response()->download($tmpFile, 'cv-jelle-traa.docx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ])->deleteFileAfterSend(true);
    }
}
