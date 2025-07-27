@extends('layouts.app')

@section('title', 'About Us - B&B Tax Accounting Services')
@section('meta_description',
    'Learn about B&B Tax and Accounting Service Limited. 15+ years of experience providing
    professional accounting services to New Zealand businesses.')

@section('content')
    <div class="min-h-screen bg-background text-foreground">

        <!-- Jumbotron -->
        @include('components.jumbotron', [
            'title' => 'About B&B Tax',
            'subtitle' => 'Your Trusted Accounting Partner',
            'description' =>
                'Over 15 years of experience helping New Zealand businesses navigate their financial challenges and achieve sustainable growth.',
            'backgroundImage' =>
                'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80',
            'icon' => '<i data-lucide="building" class="h-5 w-5 text-yellow-400"></i>',
            'badge' => 'About Our Company',
        ])

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">


            
            <!-- Company Overview -->
            @foreach($aboutData as $aboutData)
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
                            <div class="text-3xl font-bold text-primary mb-2">{{$aboutData->Experience}}</div>
                            <div class="text-muted-foreground">Years Experience</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary mb-2">{{$aboutData->client}}</div>
                            <div class="text-muted-foreground">Happy Clients</div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="relative">
                    <img src="{{ asset('storage/' . $aboutData->image) }}" alt="B&B Tax team" class="rounded-2xl shadow-xl w-full h-auto">
                        
                </div>
            </div>

            <!-- Our Values -->
            <div class="mb-20">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold mb-4 text-primary">
                        Our Core Values
                    </h2>
                    <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                        These principles guide everything we do and shape how we serve our clients
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @php
                        $values = [
                            [
                                'icon' => 'shield',
                                'title' => 'Integrity',
                                'description' =>
                                    'We maintain the highest ethical standards in all our professional dealings and always act in our clients\' best interests.',
                            ],
                            [
                                'icon' => 'star',
                                'title' => 'Excellence',
                                'description' =>
                                    'We strive for excellence in every service we provide, continuously improving our processes and expertise.',
                            ],
                            [
                                'icon' => 'users',
                                'title' => 'Partnership',
                                'description' =>
                                    'We build long-term partnerships with our clients, becoming trusted advisors who understand their unique needs.',
                            ],
                        ];
                    @endphp

                    @foreach ($values as $value)
                        <div class="gradient-card p-8 text-center border-0 rounded-xl shadow-sm">
                            <div class="w-16 h-16 bg-primary rounded-xl flex items-center justify-center mx-auto mb-6">
                                <i data-lucide="{{ $value['icon'] }}" class="h-8 w-8 text-white"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-foreground mb-4">{{ $value['title'] }}</h3>
                            <p class="text-muted-foreground leading-relaxed">{{ $value['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Why Choose Us -->
            @foreach($aboutData as $aboutData)
            <div class="mb-20">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold mb-4 text-primary">
                        {{ $aboutData->point_title }}
                    </h2>
                    <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                       {{ $aboutData->point_description }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @php
                        $advantages = [
                            [
                                'icon' => 'zap',
                                'title' => 'Modern Technology',
                                'description' =>
                                    'We use the latest cloud-based accounting software and digital tools to streamline processes and provide real-time insights.',
                            ],
                            [
                                'icon' => 'clock',
                                'title' => 'Timely Service',
                                'description' =>
                                    'We understand deadlines matter. Our efficient processes ensure all your compliance requirements are met on time.',
                            ],
                            [
                                'icon' => 'dollar-sign',
                                'title' => 'Cost-Effective Solutions',
                                'description' =>
                                    'Our competitive pricing and efficient methods provide excellent value without compromising on quality.',
                            ],
                            [
                                'icon' => 'phone',
                                'title' => 'Personal Support',
                                'description' =>
                                    'Direct access to experienced professionals who understand your business and provide personalized advice.',
                            ],
                        ];
                    @endphp

                    @foreach ($advantages as $advantage)
                        <div class="flex items-start space-x-4 p-6">
                            <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center flex-shrink-0">
                                <i data-lucide="{{ $advantage['icon'] }}" class="h-6 w-6 text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-foreground mb-2">{{ $advantage['title'] }}</h3>
                                <p class="text-muted-foreground">{{ $advantage['description'] }}</p>
                            </div>
                        </div>
                    @endforeach
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
