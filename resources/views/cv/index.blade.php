@extends('layouts.app')

@section('title', __('cv.title'))
@section('description', __('cv.description'))

@section('content')

<div class="lg:flex justify-center lg:py-24 px-4" id="cv-root">
    <div class="w-full lg:w-9/12 xl:w-7/12">
        <div class="shadow-2xl" style="background:#fff;">
            <div class="lg:flex">

                {{-- ════════════════════════════════════════════════════ --}}
                {{-- LEFT COLUMN – grey background                       --}}
                {{-- ════════════════════════════════════════════════════ --}}
                <div class="bg-brand-grey w-full lg:w-5/12 flex-shrink-0">

                    {{-- Photo --}}
                    <div class="flex justify-center pt-8 pb-4 px-4" data-aos="zoom-in" data-aos-duration="800">
                        <div class="bg-white p-2 shadow" style="width:180px;">
                            @if($settings->photo)
                                <img src="{{ Storage::url($settings->photo) }}"
                                     alt="{{ $settings->name }}"
                                     class="w-full object-cover">
                            @else
                                <img src="{{ asset('images/jelle.jpg') }}"
                                     alt="{{ $settings->name }}"
                                     class="w-full object-cover">
                            @endif
                        </div>
                    </div>

                    {{-- Name --}}
                    <div class="text-center pb-5 px-4">
                        <h1 class="text-brand-blue font-extrabold text-3xl uppercase tracking-widest">
                            {{ $settings->name }}
                        </h1>
                    </div>

                    {{-- Job title --}}
                    <div class="bg-brand-blue text-center flex justify-center py-6 px-4">
                        <div class="w-3/4">
                            <h2 class="text-white font-bold text-2xl uppercase tracking-widest">
                                {{ $locale === 'en' ? $settings->job_title_en : $settings->job_title_nl }}
                            </h2>
                        </div>
                    </div>

                    {{-- Personal details --}}
                    <div class="flex justify-center py-8 px-4">
                        <div class="w-full xl:w-10/12">

                            @if($settings->dob)
                            <div class="flex justify-between text-brand-blue pb-2">
                                <div class="uppercase font-semibold text-sm">{{ __('cv.dob') }}</div>
                                <div class="text-sm">{{ $settings->dob }}</div>
                            </div>
                            @endif

                            @if($settings->address_line1)
                            <div class="flex justify-between text-brand-blue pb-2">
                                <div class="uppercase font-semibold text-sm">{{ __('cv.address') }}</div>
                                <div class="text-right text-sm">
                                    {{ $settings->address_line1 }}
                                    @if($settings->address_line2)
                                        <br>{{ $settings->address_line2 }}
                                    @endif
                                </div>
                            </div>
                            @endif

                            @if($settings->availability)
                            <div class="flex justify-between text-brand-blue pb-2">
                                <div class="uppercase font-semibold text-sm">{{ __('cv.availability') }}</div>
                                <div class="text-sm">{{ $settings->availability }}</div>
                            </div>
                            @endif

                            @if($settings->email)
                            <div class="flex justify-between text-brand-blue pb-2">
                                <div class="uppercase font-semibold text-sm">{{ __('cv.email') }}</div>
                                <div class="text-sm">
                                    <a href="mailto:{{ $settings->email }}">{{ $settings->email }}</a>
                                </div>
                            </div>
                            @endif

                            @if($settings->phone)
                            <div class="flex justify-between text-brand-blue pb-2">
                                <div class="uppercase font-semibold text-sm">{{ __('cv.phone') }}</div>
                                <div class="text-sm">
                                    <a href="tel:{{ $settings->phone }}">{{ $settings->phone }}</a>
                                </div>
                            </div>
                            @endif

                            @if($settings->linkedin || $settings->github)
                            <div class="flex justify-between items-center text-brand-blue pb-2">
                                <div class="uppercase font-semibold text-sm">{{ __('cv.links') }}</div>
                                <div class="flex gap-2">
                                    @if($settings->linkedin)
                                    <a href="{{ $settings->linkedin }}" target="_blank"
                                       class="text-3xl text-brand-blue hover:opacity-70">
                                        <i class="fab fa-linkedin"></i>
                                    </a>
                                    @endif
                                    @if($settings->github)
                                    <a href="{{ $settings->github }}" target="_blank"
                                       class="text-3xl text-brand-blue hover:opacity-70">
                                        <i class="fab fa-github-square"></i>
                                    </a>
                                    @endif
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>

                    {{-- ── Profile ─────────────────────────────────── --}}
                    <div class="bg-brand-blue text-center flex justify-center py-6 px-4">
                        <h2 class="text-white font-bold text-2xl uppercase tracking-widest">
                            {{ __('cv.profile') }}
                        </h2>
                    </div>
                    <div class="flex justify-center py-8 px-4">
                        <div class="w-full xl:w-10/12">
                            <p class="text-brand-blue font-semibold text-sm leading-relaxed">
                                {{ $locale === 'en' ? $settings->profile_en : $settings->profile_nl }}
                            </p>
                        </div>
                    </div>

                    {{-- ── Skills ──────────────────────────────────── --}}
                    <div class="bg-brand-blue text-center flex justify-center py-6 px-4">
                        <h2 class="text-white font-bold text-2xl uppercase tracking-widest">
                            {{ __('cv.skills') }}
                        </h2>
                    </div>
                    <div class="flex justify-center py-8 px-4">
                        <div class="w-full xl:w-10/12">
                            @foreach($skills as $skill)
                            <div class="text-brand-blue pb-3">
                                <div class="uppercase font-semibold text-sm">
                                    {{ $locale === 'en' ? $skill->category_en : $skill->category_nl }}
                                </div>
                                <div class="text-sm">{{ $skill->items }}</div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- ── Education ───────────────────────────────── --}}
                    <div class="bg-brand-blue text-center flex justify-center py-6 px-4">
                        <h2 class="text-white font-bold text-2xl uppercase tracking-widest">
                            {{ __('cv.education') }}
                        </h2>
                    </div>
                    <div class="flex justify-center py-8 px-4">
                        <div class="w-full xl:w-10/12">
                            @foreach($education as $edu)
                            <div class="text-brand-blue pb-4">
                                <div class="uppercase font-semibold text-sm">
                                    {{ $locale === 'en' ? $edu->title_en : $edu->title_nl }}
                                </div>
                                <div class="text-sm">{{ $edu->period }} | {{ $edu->institution }}</div>
                                @php $learned = $locale === 'en' ? $edu->learned_en : $edu->learned_nl; @endphp
                                @if($learned)
                                <div class="text-sm mt-1">
                                    <span class="font-medium">{{ __('cv.learned') }}:</span>
                                    {{ $learned }}
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>{{-- /left column --}}

                {{-- ════════════════════════════════════════════════════ --}}
                {{-- RIGHT COLUMN – white background                     --}}
                {{-- ════════════════════════════════════════════════════ --}}
                <div class="bg-white w-full">

                    {{-- ── Work experience ─────────────────────────── --}}
                    <div class="bg-brand-blue text-center flex justify-center py-6 px-4">
                        <h2 class="text-white font-bold text-2xl uppercase tracking-widest">
                            {{ __('cv.work_experience') }}
                        </h2>
                    </div>
                    <div class="flex justify-center py-8 px-4">
                        <div class="w-full xl:w-10/12">
                            @foreach($experiences as $exp)
                            <div class="text-brand-blue pb-6" data-aos="fade-up" data-aos-duration="500">
                                <div class="font-semibold text-sm">{{ $exp->period }}</div>

                                @if($exp->company)
                                <div class="font-medium text-sm mt-0.5">{{ $exp->company }}</div>
                                @endif

                                @php $desc = $locale === 'en' ? $exp->description_en : $exp->description_nl; @endphp
                                @if($desc)
                                <div class="ml-4 mt-1 text-sm leading-relaxed">{{ $desc }}</div>
                                @endif

                                @if($exp->url)
                                <div class="ml-4 mt-1 text-sm">
                                    <a class="underline hover:opacity-70"
                                       href="{{ $exp->url }}" target="_blank">{{ $exp->url }}</a>
                                </div>
                                @endif

                                @if($exp->tech_stack)
                                <div class="ml-4 mt-1 text-sm">
                                    <span class="font-medium">{{ __('cv.method') }}:</span>
                                    {{ $exp->tech_stack }}
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>{{-- /right column --}}

            </div>{{-- /lg:flex --}}
        </div>{{-- /shadow card --}}
    </div>
</div>

@endsection
