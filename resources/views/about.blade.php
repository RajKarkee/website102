@extends('layouts.app')

@section('title', 'About Us - B&B Tax Accounting Services')
@section('meta_description', 'Learn about B&B Tax and Accounting Service Limited. 15+ years of experience providing professional accounting services to New Zealand businesses.')

@section('content')
<div class="min-h-screen bg-background text-foreground">
    
    <!-- Jumbotron -->
    @include('components.jumbotron', [
        'title' => 'About B&B Tax',
        'subtitle' => 'Your Trusted Accounting Partner',
        'description' => 'Over 15 years of experience helping New Zealand businesses navigate their financial challenges and achieve sustainable growth.',
        'backgroundImage' => 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80',
        'icon' => '<i data-lucide="building" class="h-5 w-5 text-yellow-400"></i>',
        'badge' => 'About Our Company'
    ])

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        
        <!-- Company Overview -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-20">
            <div>
                <h2 class="text-3xl font-bold mb-6 text-primary">
                    Professional Accounting Excellence
                </h2>
                <p class="text-lg text-muted-foreground mb-6 leading-relaxed">
                    At B&B Tax and Accounting Service Limited, we specialize in providing comprehensive 
                    accounting services tailored to the needs of small and medium businesses across New Zealand. 
                    Our experienced team is dedicated to helping you stay compliant, organized, and focused on 
                    growing your business.
                </p>
                <p class="text-lg text-muted-foreground mb-8 leading-relaxed">
                    With over 15 years in the industry, we understand the unique challenges facing New Zealand 
                    businesses. Our modern approach combines traditional accounting expertise with cutting-edge 
                    technology to deliver efficient, accurate, and cost-effective solutions.
                </p>
                
                <div class="grid grid-cols-2 gap-6">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-primary mb-2">15+</div>
                        <div class="text-muted-foreground">Years Experience</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-primary mb-2">500+</div>
                        <div class="text-muted-foreground">Happy Clients</div>
                    </div>
                </div>
            </div>
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                     alt="B&B Tax team at work"
                     class="rounded-2xl shadow-xl">
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
                            'description' => 'We maintain the highest ethical standards in all our professional dealings and always act in our clients\' best interests.'
                        ],
                        [
                            'icon' => 'star',
                            'title' => 'Excellence',
                            'description' => 'We strive for excellence in every service we provide, continuously improving our processes and expertise.'
                        ],
                        [
                            'icon' => 'users',
                            'title' => 'Partnership',
                            'description' => 'We build long-term partnerships with our clients, becoming trusted advisors who understand their unique needs.'
                        ]
                    ];
                @endphp

                @foreach($values as $value)
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
        <div class="mb-20">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4 text-primary">
                    Why Choose B&B Tax?
                </h2>
                <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                    Discover what sets us apart from other accounting firms
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @php
                    $advantages = [
                        [
                            'icon' => 'zap',
                            'title' => 'Modern Technology',
                            'description' => 'We use the latest cloud-based accounting software and digital tools to streamline processes and provide real-time insights.'
                        ],
                        [
                            'icon' => 'clock',
                            'title' => 'Timely Service',
                            'description' => 'We understand deadlines matter. Our efficient processes ensure all your compliance requirements are met on time.'
                        ],
                        [
                            'icon' => 'dollar-sign',
                            'title' => 'Cost-Effective Solutions',
                            'description' => 'Our competitive pricing and efficient methods provide excellent value without compromising on quality.'
                        ],
                        [
                            'icon' => 'phone',
                            'title' => 'Personal Support',
                            'description' => 'Direct access to experienced professionals who understand your business and provide personalized advice.'
                        ]
                    ];
                @endphp

                @foreach($advantages as $advantage)
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

        <!-- Call to Action -->
        <div class="text-center bg-primary/10 rounded-3xl p-12 border border-primary/20">
            <i data-lucide="handshake" class="h-16 w-16 text-primary mx-auto mb-6"></i>
            <h2 class="text-3xl font-bold mb-6 text-primary">
                Ready to Partner With Us?
            </h2>
            <p class="text-lg text-muted-foreground mb-8 max-w-2xl mx-auto">
                Join hundreds of satisfied clients who trust B&B Tax with their accounting needs. 
                Let's discuss how we can help your business thrive.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact') }}" 
                   class="bg-primary hover:bg-primary/90 text-white px-8 py-4 rounded-full text-lg font-semibold inline-flex items-center justify-center transition-colors">
                    Get Started Today
                    <i data-lucide="arrow-right" class="ml-2 h-5 w-5"></i>
                </a>
                <a href="{{ route('services.index') }}" 
                   class="border border-primary text-primary hover:bg-primary/10 px-8 py-4 rounded-full text-lg font-semibold inline-flex items-center justify-center transition-colors">
                    Our Services
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
