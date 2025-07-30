@extends('layouts.app')

@section('title', 'Client Testimonials - B&B Tax')
@section('meta_description', 'Read what our clients say about B&B Tax accounting services. Real testimonials from satisfied New Zealand businesses.')

@section('content')
    <div class="min-h-screen bg-background text-foreground">

        <!-- Jumbotron -->
        @include('components.jumbotron', [
            'title' => 'What Our Clients Say',
            'subtitle' => 'Real Stories, Real Results',
            'description' => 'Discover how B&B Tax has helped New Zealand businesses streamline their accounting, improve cash flow, and achieve their financial goals.',
            'backgroundImage' => 'https://images.unsplash.com/photo-1556745757-8d76bdb6984b?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80',
            'icon' => '<i data-lucide="star" class="h-5 w-5 text-yellow-400"></i>',
            'badge' => 'Client Reviews',
        ])

        <!-- Testimonials Section -->
        <section class="py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <!-- Stats Section -->
                <div class="bg-primary/10 rounded-3xl p-12 mb-16 border border-primary/20">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                        <div>
                            <div class="text-4xl font-bold text-primary mb-2">15+</div>
                            <div class="text-muted-foreground">Years Experience</div>
                        </div>
                        <div>
                            <div class="text-4xl font-bold text-primary mb-2">500+</div>
                            <div class="text-muted-foreground">Happy Clients</div>
                        </div>
                        <div>
                            <div class="text-4xl font-bold text-primary mb-2">98%</div>
                            <div class="text-muted-foreground">Client Satisfaction</div>
                        </div>
                        <div>
                            <div class="text-4xl font-bold text-primary mb-2">24/7</div>
                            <div class="text-muted-foreground">Support Available</div>
                        </div>
                    </div>
                </div>

                <!-- Testimonials Grid -->
                @php
                    $testimonials = \App\Models\Testimonial::where('status', 1)->get();
                @endphp

                @if($testimonials->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                        @foreach ($testimonials as $testimonial)
                            <div class="gradient-card hover:scale-105 transition-all duration-300 group border-0 overflow-hidden bg-card rounded-xl shadow-sm">
                                <div class="p-8">
                                    <!-- Quote Icon -->
                                    <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center mb-6">
                                        <i data-lucide="quote" class="h-6 w-6 text-primary"></i>
                                    </div>

                                    <!-- Rating Stars -->
                                    <div class="flex items-center mb-4">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i data-lucide="star" class="h-4 w-4 fill-yellow-400 text-yellow-400"></i>
                                        @endfor
                                    </div>

                                    <!-- Testimonial Text -->
                                    <p class="text-muted-foreground leading-relaxed mb-6 italic">
                                        "{{ $testimonial->description }}"
                                    </p>

                                    @if($testimonial->sub_description)
                                        <p class="text-sm text-muted-foreground/80 mb-6">
                                            {{ $testimonial->sub_description }}
                                        </p>
                                    @endif

                                    <!-- Client Info -->
                                    <div class="flex items-center">
                                        @if($testimonial->image)
                                            <img src="{{ asset('storage/' . $testimonial->image) }}" 
                                                 alt="Client"
                                                 class="w-12 h-12 rounded-full object-cover mr-4 border-2 border-primary/20">
                                        @else
                                            <div class="w-12 h-12 bg-primary/20 rounded-full flex items-center justify-center mr-4">
                                                <i data-lucide="user" class="h-6 w-6 text-primary"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="font-semibold text-foreground">
                                                {{ $testimonial->others ?? 'Satisfied Client' }}
                                            </div>
                                            <div class="text-sm text-muted-foreground">Business Owner</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Sample Testimonials -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                        @php
                            $sampleTestimonials = [
                                [
                                    'text' => 'B&B Tax has transformed how we handle our accounting. Their expertise in New Zealand tax law and professional service has saved us time and money.',
                                    'name' => 'Sarah Mitchell',
                                    'company' => 'Mitchell Construction Ltd',
                                ],
                                [
                                    'text' => 'The team at B&B Tax is incredibly knowledgeable and responsive. They helped us streamline our payroll and GST processes, making compliance much easier.',
                                    'name' => 'David Chen',
                                    'company' => 'Chen Digital Solutions',
                                ],
                                [
                                    'text' => 'Professional, reliable, and always available when we need them. B&B Tax has been instrumental in our business growth over the past 5 years.',
                                    'name' => 'Lisa Thompson',
                                    'company' => 'Thompson Healthcare Services',
                                ],
                                [
                                    'text' => 'Their Xero training was excellent - our staff now feel confident managing our accounts, and we have better visibility of our financial position.',
                                    'name' => 'Mark Williams',
                                    'company' => 'Williams Manufacturing',
                                ],
                                [
                                    'text' => 'The credit control services have significantly improved our cash flow. We can now focus on growing our business instead of chasing payments.',
                                    'name' => 'Emma Rodriguez',
                                    'company' => 'Rodriguez Retail Group',
                                ],
                                [
                                    'text' => 'Outstanding service and attention to detail. B&B Tax helped us navigate complex tax regulations and saved us thousands in potential penalties.',
                                    'name' => 'James Anderson',
                                    'company' => 'Anderson Property Investments',
                                ],
                            ];
                        @endphp

                        @foreach ($sampleTestimonials as $testimonial)
                            <div class="gradient-card hover:scale-105 transition-all duration-300 group border-0 overflow-hidden bg-card rounded-xl shadow-sm">
                                <div class="p-8">
                                    <!-- Quote Icon -->
                                    <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center mb-6">
                                        <i data-lucide="quote" class="h-6 w-6 text-primary"></i>
                                    </div>

                                    <!-- Rating Stars -->
                                    <div class="flex items-center mb-4">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i data-lucide="star" class="h-4 w-4 fill-yellow-400 text-yellow-400"></i>
                                        @endfor
                                    </div>

                                    <!-- Testimonial Text -->
                                    <p class="text-muted-foreground leading-relaxed mb-6 italic">
                                        "{{ $testimonial['text'] }}"
                                    </p>

                                    <!-- Client Info -->
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-primary/20 rounded-full flex items-center justify-center mr-4">
                                            <i data-lucide="user" class="h-6 w-6 text-primary"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-foreground">{{ $testimonial['name'] }}</div>
                                            <div class="text-sm text-muted-foreground">{{ $testimonial['company'] }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Trust Indicators -->
                <div class="bg-secondary rounded-3xl p-12 mb-16">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold mb-4 text-primary">Why Clients Choose B&B Tax</h2>
                        <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                            Our commitment to excellence and client satisfaction sets us apart
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-primary rounded-xl flex items-center justify-center mx-auto mb-4">
                                <i data-lucide="shield-check" class="h-8 w-8 text-white"></i>
                            </div>
                            <h3 class="font-semibold text-foreground mb-2">Trusted Expertise</h3>
                            <p class="text-sm text-muted-foreground">15+ years of proven experience</p>
                        </div>

                        <div class="text-center">
                            <div class="w-16 h-16 bg-primary rounded-xl flex items-center justify-center mx-auto mb-4">
                                <i data-lucide="clock" class="h-8 w-8 text-white"></i>
                            </div>
                            <h3 class="font-semibold text-foreground mb-2">Timely Service</h3>
                            <p class="text-sm text-muted-foreground">Always meeting deadlines</p>
                        </div>

                        <div class="text-center">
                            <div class="w-16 h-16 bg-primary rounded-xl flex items-center justify-center mx-auto mb-4">
                                <i data-lucide="phone" class="h-8 w-8 text-white"></i>
                            </div>
                            <h3 class="font-semibold text-foreground mb-2">Responsive Support</h3>
                            <p class="text-sm text-muted-foreground">Quick answers when you need them</p>
                        </div>

                        <div class="text-center">
                            <div class="w-16 h-16 bg-primary rounded-xl flex items-center justify-center mx-auto mb-4">
                                <i data-lucide="trending-up" class="h-8 w-8 text-white"></i>
                            </div>
                            <h3 class="font-semibold text-foreground mb-2">Business Growth</h3>
                            <p class="text-sm text-muted-foreground">Helping clients achieve success</p>
                        </div>
                    </div>
                </div>

                <!-- CTA Section -->
                @php
                    $cta = \App\Models\Cta::where('page', 'testimonials')->first();
                @endphp
                @if ($cta)
                    <div class="text-center bg-primary/10 rounded-3xl p-12 border border-primary/20">
                        <i data-lucide="{{ $cta->icon ?? 'star' }}" class="h-16 w-16 text-primary mx-auto mb-6"></i>
                        @include('components.cta', [
                            'icon' => $cta->icon ?? 'star',
                            'title' => $cta->title,
                            'description' => $cta->description,
                            'button1_text' => $cta->button1_text,
                            'button2_text' => $cta->button2_text,
                        ])
                    </div>
                @else
                    <div class="text-center bg-primary/10 rounded-3xl p-12 border border-primary/20">
                        <i data-lucide="heart" class="h-16 w-16 text-primary mx-auto mb-6"></i>
                        <h2 class="text-3xl font-bold text-foreground mb-4">Ready to Join Our Success Stories?</h2>
                        <p class="text-lg text-muted-foreground mb-8 max-w-2xl mx-auto">
                            Experience the professional service and expertise that our clients love. Contact us today to see how we can help your business thrive.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="{{ route('contact') }}" 
                               class="bg-primary hover:bg-primary/90 text-white px-8 py-4 rounded-full font-semibold inline-flex items-center justify-center transition-colors">
                                Start Your Success Story
                                <i data-lucide="arrow-right" class="ml-2 h-5 w-5"></i>
                            </a>
                            <a href="{{ route('services.index') }}" 
                               class="border border-primary text-primary hover:bg-primary/10 px-8 py-4 rounded-full font-semibold inline-flex items-center justify-center transition-colors">
                                Explore Our Services
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection
