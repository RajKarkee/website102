@extends('layouts.app')

@section('title', 'Our Team - B&B Tax')
@section('meta_description', 'Meet the experienced accounting professionals at B&B Tax who are dedicated to helping your New Zealand business succeed.')

@section('content')
    <div class="min-h-screen bg-background text-foreground">

        <!-- Jumbotron -->
        @include('components.jumbotron', [
            'title' => 'Meet Our Team',
            'subtitle' => 'Experienced Professionals',
            'description' => 'Our team of qualified accountants and business advisors are here to help your business thrive with personalized service and expert guidance.',
            'backgroundImage' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80',
            'icon' => '<i data-lucide="users" class="h-5 w-5 text-yellow-400"></i>',
            'badge' => 'Our Team',
        ])

        <!-- Team Section -->
        <section class="py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <!-- Team Introduction -->
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold mb-6">
                        <span class="text-primary">Professional Excellence</span>
                    </h2>
                    <p class="text-lg text-muted-foreground max-w-3xl mx-auto leading-relaxed">
                        Our team combines years of experience with a commitment to staying current with New Zealand's 
                        ever-changing tax and accounting regulations. We pride ourselves on building lasting relationships 
                        with our clients and providing personalized service that helps businesses grow.
                    </p>
                </div>

                <!-- Team Grid -->
                @php
                    $teamMembers = \App\Models\Team::with('position')->get();
                @endphp

                @if($teamMembers->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mb-16">
                        @foreach ($teamMembers as $member)
                            <div class="gradient-card hover:scale-105 transition-all duration-300 group border-0 overflow-hidden bg-card rounded-xl shadow-sm">
                                <div class="p-6 text-center">
                                    <!-- Photo -->
                                    <div class="relative mb-6">
                                        <img src="{{ $member->image ? asset('storage/' . $member->image) : 'https://ui-avatars.com/api/?name=' . urlencode($member->name) . '&background=0D8ABC&color=fff&size=200' }}"
                                            alt="{{ $member->name }}"
                                            class="w-32 h-32 rounded-full object-cover mx-auto border-4 border-primary/20 group-hover:border-primary/40 transition-colors">
                                        <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                                            <i data-lucide="check" class="h-4 w-4 text-white"></i>
                                        </div>
                                    </div>
                                    
                                    <!-- Info -->
                                    <h3 class="text-xl font-semibold text-foreground mb-2">{{ $member->name }}</h3>
                                    <p class="text-primary font-medium mb-4">{{ $member->position->name ?? 'Team Member' }}</p>
                                    
                                    <!-- Badge -->
                                    <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary/10 text-primary">
                                        <i data-lucide="award" class="h-3 w-3 mr-1"></i>
                                        Certified Professional
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-16">
                        <div class="w-24 h-24 bg-muted rounded-full flex items-center justify-center mx-auto mb-6">
                            <i data-lucide="users" class="h-12 w-12 text-muted-foreground"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-foreground mb-2">Team Information Coming Soon</h3>
                        <p class="text-muted-foreground max-w-md mx-auto">
                            We're updating our team profiles. Please check back soon to meet our amazing team members.
                        </p>
                    </div>
                @endif

                <!-- Team Values -->
                <div class="bg-secondary rounded-3xl p-12 mb-16">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold mb-4 text-primary">What Makes Our Team Special</h2>
                        <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                            Our commitment to excellence and client success drives everything we do
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-primary rounded-xl flex items-center justify-center mx-auto mb-6">
                                <i data-lucide="graduation-cap" class="h-8 w-8 text-white"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-foreground mb-4">Qualified Experts</h3>
                            <p class="text-muted-foreground leading-relaxed">
                                Our team holds professional qualifications and stays updated with the latest industry standards and regulations.
                            </p>
                        </div>

                        <div class="text-center">
                            <div class="w-16 h-16 bg-primary rounded-xl flex items-center justify-center mx-auto mb-6">
                                <i data-lucide="clock" class="h-8 w-8 text-white"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-foreground mb-4">Years of Experience</h3>
                            <p class="text-muted-foreground leading-relaxed">
                                With over 15 years of combined experience, we understand the unique challenges facing New Zealand businesses.
                            </p>
                        </div>

                        <div class="text-center">
                            <div class="w-16 h-16 bg-primary rounded-xl flex items-center justify-center mx-auto mb-6">
                                <i data-lucide="heart" class="h-8 w-8 text-white"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-foreground mb-4">Client-Focused</h3>
                            <p class="text-muted-foreground leading-relaxed">
                                We build lasting relationships and provide personalized service tailored to each client's specific needs.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- CTA Section -->
                @php
                    $cta = \App\Models\Cta::where('page', 'team')->first();
                @endphp
                @if ($cta)
                    <div class="text-center bg-primary/10 rounded-3xl p-12 border border-primary/20">
                        <i data-lucide="{{ $cta->icon ?? 'users' }}" class="h-16 w-16 text-primary mx-auto mb-6"></i>
                        @include('components.cta', [
                            'icon' => $cta->icon ?? 'users',
                            'title' => $cta->title,
                            'description' => $cta->description,
                            'button1_text' => $cta->button1_text,
                            'button2_text' => $cta->button2_text,
                        ])
                    </div>
                @else
                    <div class="text-center bg-primary/10 rounded-3xl p-12 border border-primary/20">
                        <i data-lucide="phone" class="h-16 w-16 text-primary mx-auto mb-6"></i>
                        <h2 class="text-3xl font-bold text-foreground mb-4">Ready to Work with Our Team?</h2>
                        <p class="text-lg text-muted-foreground mb-8 max-w-2xl mx-auto">
                            Contact us today to discuss how our experienced team can help your business achieve its financial goals.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="{{ route('contact') }}" 
                               class="bg-primary hover:bg-primary/90 text-white px-8 py-4 rounded-full font-semibold inline-flex items-center justify-center transition-colors">
                                Get in Touch
                                <i data-lucide="arrow-right" class="ml-2 h-5 w-5"></i>
                            </a>
                            <a href="{{ route('services.index') }}" 
                               class="border border-primary text-primary hover:bg-primary/10 px-8 py-4 rounded-full font-semibold inline-flex items-center justify-center transition-colors">
                                View Our Services
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection
