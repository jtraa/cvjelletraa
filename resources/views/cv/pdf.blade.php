<!DOCTYPE html>
<html lang="{{ $locale }}">
<head>
<meta charset="utf-8">
<style>
/* NO @page rule — margins set via PHP to avoid dompdf blank-page bug */
* { margin: 0; padding: 0; box-sizing: border-box; }
html, body { height: auto; width: 100%; }
body { font-family: DejaVu Sans, sans-serif; font-size: 9pt; color: #21254a; }

/* ── Section header ── */
.sh { background-color: #21254a; text-align: center; padding: 5px 12px; }
.sh h2 {
    color: #ffffff;
    font-size: 8pt;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* ── Content block ── */
.cb { padding: 7px 12px 7px 12px; }

/* ── Photo ── */
.photo-wrap  { text-align: center; padding: 10px 12px 3px 12px; }
.photo-frame { display: inline-block; background-color: #ffffff; padding: 4px; border: 1px solid #cccccc; }
.photo-frame img { display: block; width: 105px; height: 105px; }

/* ── Name ── */
.name-wrap { text-align: center; padding: 4px 12px 7px 12px; }
.name-wrap h1 {
    font-size: 13pt;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: #21254a;
}

/* ── Detail rows ── */
.dt       { width: 100%; border-collapse: collapse; margin-bottom: 3px; }
.dt-label { font-weight: bold; font-size: 6.5pt; text-transform: uppercase; width: 46%; vertical-align: top; padding-right: 3px; }
.dt-value { font-size: 7pt; text-align: right; vertical-align: top; word-break: break-all; }

/* ── Profile ── */
.profile-text { font-size: 7.5pt; line-height: 1.45; }

/* ── Skills ── */
.skill-cat { font-weight: bold; font-size: 6.5pt; text-transform: uppercase; margin-top: 3px; }
.skill-val { font-size: 7pt; margin-top: 1px; margin-bottom: 3px; }

/* ── Education ── */
.edu-entry  { margin-bottom: 5px; }
.edu-title  { font-weight: bold; font-size: 7pt; text-transform: uppercase; }
.edu-meta   { font-size: 6.5pt; margin-top: 1px; }
.edu-learned{ font-size: 6.5pt; margin-top: 1px; }

/* ── Work experience ── */
.exp-entry   { margin-bottom: 7px; }
.exp-period  { font-weight: bold; font-size: 8pt; }
.exp-company { font-style: italic; font-size: 7.5pt; margin-top: 1px; }
.exp-desc    { font-size: 7.5pt; margin: 2px 0 2px 7px; line-height: 1.4; }
.exp-url     { font-size: 6.5pt; margin-left: 7px; margin-top: 1px; word-break: break-all; }
.exp-tech    { font-size: 7pt; margin-left: 7px; margin-top: 1px; font-style: italic; }
</style>
</head>
<body>
{{-- Real HTML table — most reliable two-column layout in dompdf --}}
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>

    {{-- ═══════════════ LEFT COLUMN (grey) ═══════════════ --}}
    <td width="38%" bgcolor="#e5e6ea" valign="top">

        {{-- Photo --}}
        @if($photoDataUri)
        <div class="photo-wrap">
            <div class="photo-frame">
                <img src="{{ $photoDataUri }}" alt="{{ $settings->name }}">
            </div>
        </div>
        @endif

        {{-- Name --}}
        <div class="name-wrap">
            <h1>{{ $settings->name }}</h1>
        </div>

        {{-- Job title --}}
        <div class="sh">
            <h2>{{ $locale === 'en' ? $settings->job_title_en : $settings->job_title_nl }}</h2>
        </div>

        {{-- Contact details --}}
        <div class="cb">
            @if($settings->dob)
            <table class="dt"><tr>
                <td class="dt-label">{{ $locale === 'en' ? 'Date of birth' : 'Geboortedatum' }}</td>
                <td class="dt-value">{{ $settings->dob }}</td>
            </tr></table>
            @endif
            @if($settings->address_line1)
            <table class="dt"><tr>
                <td class="dt-label">{{ $locale === 'en' ? 'City' : 'Woonplaats' }}</td>
                <td class="dt-value">{{ $settings->address_line1 }}@if($settings->address_line2)<br>{{ $settings->address_line2 }}@endif</td>
            </tr></table>
            @endif
            @if($settings->availability)
            <table class="dt"><tr>
                <td class="dt-label">{{ $locale === 'en' ? 'Availability' : 'Beschikbaar' }}</td>
                <td class="dt-value">{{ $settings->availability }}</td>
            </tr></table>
            @endif
            @if($settings->email)
            <table class="dt"><tr>
                <td class="dt-label">E-mail</td>
                <td class="dt-value">{{ $settings->email }}</td>
            </tr></table>
            @endif
            @if($settings->phone)
            <table class="dt"><tr>
                <td class="dt-label">{{ $locale === 'en' ? 'Phone' : 'Telefoon' }}</td>
                <td class="dt-value">{{ $settings->phone }}</td>
            </tr></table>
            @endif
            @if($settings->linkedin)
            <table class="dt"><tr>
                <td class="dt-label">LinkedIn</td>
                <td class="dt-value">{{ $settings->linkedin }}</td>
            </tr></table>
            @endif
            @if($settings->github)
            <table class="dt"><tr>
                <td class="dt-label">GitHub</td>
                <td class="dt-value">{{ $settings->github }}</td>
            </tr></table>
            @endif
        </div>

        {{-- Profile --}}
        <div class="sh"><h2>{{ $locale === 'en' ? 'Profile' : 'Profiel' }}</h2></div>
        <div class="cb">
            <p class="profile-text">{{ $locale === 'en' ? $settings->profile_en : $settings->profile_nl }}</p>
        </div>

        {{-- Skills --}}
        <div class="sh"><h2>{{ $locale === 'en' ? 'Skills' : 'Vaardigheden' }}</h2></div>
        <div class="cb">
            @foreach($skills as $skill)
            <div class="skill-cat">{{ $locale === 'en' ? $skill->category_en : $skill->category_nl }}</div>
            <div class="skill-val">{{ $skill->items }}</div>
            @endforeach
        </div>

        {{-- Education --}}
        <div class="sh"><h2>{{ $locale === 'en' ? 'Education' : 'Educatie' }}</h2></div>
        <div class="cb">
            @foreach($education as $edu)
            <div class="edu-entry">
                <div class="edu-title">{{ $locale === 'en' ? $edu->title_en : $edu->title_nl }}</div>
                <div class="edu-meta">{{ $edu->period }} | {{ $edu->institution }}</div>
                @php $learned = $locale === 'en' ? $edu->learned_en : $edu->learned_nl; @endphp
                @if($learned)
                <div class="edu-learned"><strong>{{ $locale === 'en' ? 'Learned' : 'Geleerd' }}:</strong> {{ $learned }}</div>
                @endif
            </div>
            @endforeach
        </div>

    </td>{{-- /left --}}

    {{-- ═══════════════ RIGHT COLUMN (white) ══════════════ --}}
    <td width="62%" bgcolor="#ffffff" valign="top">

        <div class="sh">
            <h2>{{ $locale === 'en' ? 'Work experience' : 'Werkervaring' }}</h2>
        </div>

        <div class="cb">
            @foreach($experiences as $exp)
            <div class="exp-entry">
                <div class="exp-period">{{ $exp->period }}</div>
                @if($exp->company)
                <div class="exp-company">{{ $exp->company }}</div>
                @endif
                @php $desc = $locale === 'en' ? $exp->description_en : $exp->description_nl; @endphp
                @if($desc)
                <div class="exp-desc">{{ $desc }}</div>
                @endif
                @if($exp->url)
                <div class="exp-url">{{ $exp->url }}</div>
                @endif
                @if($exp->tech_stack)
                <div class="exp-tech"><strong>{{ $locale === 'en' ? 'Methodology' : 'Werkwijze' }}:</strong> {{ $exp->tech_stack }}</div>
                @endif
            </div>
            @endforeach
        </div>

    </td>{{-- /right --}}

</tr>
</table>
</body>
</html>
