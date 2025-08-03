@extends('layouts.app')

@section('title', 'About Us - B&B Tax Accounting Services')
@section('meta_description',
    'Learn about B&B Tax and Accounting Service Limited. 15+ years of experience providing professional accounting services to New Zealand businesses.')

@section('content')
    <div class="min-h-screen bg-background text-foreground">

        <!-- Jumbotron -->
        @include('components.jumbotron')

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

            <!-- Company Overview -->
            @foreach ($aboutData as $aboutData)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-20">
                    <div>
                        <h2 class="text-3xl font-bold mb-6 text-primary">
                            {{ $aboutData->title }}
                        </h2>
                        @php
                            $description = strip_tags($aboutData->description ?? '');
                            if (!is_string($description)) {
                                $description = (string) $description;
                            }
                            $words = str_word_count($description, 1);
                            $half = ceil(count($words) / 2);
                            $firstHalf = implode(' ', array_slice($words, 0, $half));
                            $secondHalf = implode(' ', array_slice($words, $half));
                        @endphp

                        <p class="text-lg text-muted-foreground mb-6 leading-relaxed">
                            {{ $firstHalf }}
                        </p>
                        <p class="text-lg text-muted-foreground mb-8 leading-relaxed">
                            {{ $secondHalf }}
                        </p>

                        <div class="grid grid-cols-2 gap-6">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-primary mb-2">{{ $aboutData->Experience }}</div>
                                <div class="text-muted-foreground">Years Experience</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-primary mb-2">{{ $aboutData->client }}</div>
                                <div class="text-muted-foreground">Happy Clients</div>
                            </div>
                        </div>
                    </div>
                    <div class="relative">
                        <img src="{{ asset('storage/' . $aboutData->image) }}" alt="B&B Tax team"
                            class="rounded-2xl shadow-xl w-full h-auto">
                    </div>
                </div>
            @endforeach

@include('components.values')
            <!-- Why Choose Us -->
            <div class="mb-20">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold mb-4 text-primary">
                        {{ $about->point_title }}
                    </h2>
                    <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                        {{ $about->point_description }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @for ($i = 1; $i <= 4; $i++)
                        <div class="flex items-start space-x-4 p-6">
                            <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center flex-shrink-0">
                                @if (!empty($points[$i]['icon']))
                               
                                    <img src="{{ asset('storage/' . $points[$i]['icon']) }}" alt="Icon {{ $i }}"
                                       >
                                @else
                                    <span class="text-muted">No icon</span>
                                @endif
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-foreground mb-2">{{ $points[$i]['title'] }}</h3>
                                <p class="text-muted-foreground">{{ $points[$i]['description'] }}</p>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Dynamic CTA -->
            @php
                $cta = \App\Models\Cta::where('page', 'about')->first();
            @endphp
            @if ($cta)
                <div class="text-center bg-primary/10 rounded-3xl p-12 border border-primary/20">
                    <i data-lucide="{{ $cta->icon ?? 'target' }}" class="h-16 w-16 text-primary mx-auto mb-6"></i>
                    @include('components.cta', [
                        'icon' => $cta->icon ?? 'target',
                        'title' => $cta->title,
                        'description' => $cta->description,
                        'button1_text' => $cta->button1_text,
                        'button2_text' => $cta->button2_text,
                    ])
                </div>
            @endif

        </div>
    </div>
@endsection
