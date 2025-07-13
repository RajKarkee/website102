@extends('layouts.app')

@section('title', 'B&B Tax - Professional Accounting Services for New Zealand Businesses')
@section('meta_description', 'Professional accounting services for New Zealand businesses. Payroll management, GST filing, tax returns, and Xero training. 15+ years experience.')

@section('content')
<div class="min-h-screen bg-background overflow-x-hidden">
    <!-- Hero Section with Slider -->
    <section id="home" class="pt-16 sm:pt-20 min-h-screen flex items-center relative overflow-hidden" x-data="heroCarousel()">
        <div class="w-full relative">
            <!-- Slides Container -->
            <div class="relative">
                @foreach($heroSlides as $index => $slide)
                    <div x-show="currentSlide === {{ $index }}" 
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0 transform translate-x-full"
                         x-transition:enter-end="opacity-100 transform translate-x-0"
                         x-transition:leave="transition ease-in duration-500"
                         x-transition:leave-start="opacity-100 transform translate-x-0"
                         x-transition:leave-end="opacity-0 transform -translate-x-full"
                         class="relative min-h-screen bg-cover bg-center bg-no-repeat flex items-center"
                         style="background-image: url('{{ $slide['backgroundImage'] }}');">
                        
                        <div class="absolute inset-0 bg-black/60"></div>
                        
                        <!-- Content Container -->
                        <div class="relative z-20 w-full">
                            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-20">
                                <div class="max-w-3xl">
                                    <div class="flex items-center space-x-2 mb-4 sm:mb-6">
                                        <i data-lucide="sparkles" class="h-4 w-4 sm:h-5 sm:w-5 text-yellow-400"></i>
                                        <span class="text-yellow-400 font-mono text-xs sm:text-sm tracking-wider uppercase">Comprehensive Accounting Services</span>
                                    </div>
                                    
                                    <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold leading-tight mb-6 sm:mb-8 text-white">
                                        {{ $slide['title'] }}
                                        @if($slide['subtitle'])
                                            <br>
                                            <span class="text-white/90 text-base sm:text-lg md:text-xl lg:text-2xl font-normal">{{ $slide['subtitle'] }}</span>
                                        @endif
                                    </h1>
                                    
                                    <p class="text-base sm:text-lg md:text-xl text-white/90 leading-relaxed mb-8 sm:mb-12 max-w-2xl">
                                        {{ $slide['description'] }}
                                    </p>
                                    
                                    <div class="flex flex-col sm:flex-row gap-4 mb-12 sm:mb-16">
                                        <a href="{{ route('contact') }}" class="bg-yellow-500 hover:bg-yellow-400 text-black font-bold px-6 sm:px-10 py-3 sm:py-4 text-base sm:text-lg h-12 sm:h-14 w-full sm:w-auto sm:min-w-[220px] rounded-none text-center transition-colors">
                                            Discover how
                                        </a>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                                        @foreach($slide['features'] as $feature)
                                            <div class="flex items-center space-x-2 sm:space-x-3 text-white/90">
                                                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center flex-shrink-0">
                                                    <i data-lucide="{{ $feature['icon'] }}" class="h-4 w-4 sm:h-5 sm:w-5 text-white"></i>
                                                </div>
                                                <span class="font-medium text-sm sm:text-base">{{ $feature['text'] }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation Arrows -->
                        <div class="absolute left-2 sm:left-4 lg:left-8 top-1/2 -translate-y-1/2 z-30 hidden sm:block">
                            <button @click="previousSlide()" class="bg-white/10 backdrop-blur-sm border border-white/20 hover:bg-white/20 text-white w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center transition-colors">
                                <i data-lucide="chevron-left" class="h-6 w-6"></i>
                            </button>
                        </div>
                        <div class="absolute right-2 sm:right-4 lg:right-8 top-1/2 -translate-y-1/2 z-30 hidden sm:block">
                            <button @click="nextSlide()" class="bg-white/10 backdrop-blur-sm border border-white/20 hover:bg-white/20 text-white w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center transition-colors">
                                <i data-lucide="chevron-right" class="h-6 w-6"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
                
                <!-- Slide indicators -->
                <div class="absolute bottom-4 sm:bottom-8 left-1/2 -translate-x-1/2 flex space-x-2 sm:space-x-3 z-30">
                    @foreach($heroSlides as $index => $slide)
                        <button @click="goToSlide({{ $index }})"
                                :class="currentSlide === {{ $index }} ? 'bg-white' : 'bg-white/40 hover:bg-white/60'"
                                class="w-8 sm:w-12 h-1 rounded-full transition-all duration-300">
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Services Summary -->
    <section class="py-20 relative">
        <div class="absolute inset-0 bg-background/20"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-6">
                    <span class="text-primary">
                        Our Services
                    </span>
                </h2>
                <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                    Comprehensive accounting solutions tailored for New Zealand businesses
                </p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 sm:gap-6 mb-12">
                @foreach($services as $service)
                    <div class="gradient-card hover:scale-105 transition-all duration-300 group border-0 h-full bg-card rounded-xl shadow-sm">
                        <div class="p-4 sm:p-6 text-center flex flex-col h-full">
                            <div class="w-12 h-12 bg-primary rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                                <i data-lucide="{{ $service['icon'] }}" class="h-6 w-6 text-white"></i>
                            </div>
                            <h3 class="font-semibold text-foreground mb-2 text-sm">{{ $service['title'] }}</h3>
                            <p class="hidden sm:block text-xs text-muted-foreground leading-relaxed mb-4 flex-grow">{{ $service['desc'] }}</p>
                            <div class="mt-auto flex justify-center sm:justify-end">
                                <a href="{{ route($service['link']) }}" class="text-primary hover:text-primary/80 font-medium text-xs inline-flex items-center transition-colors">
                                    View Details
                                    <i data-lucide="arrow-right" class="ml-1 h-3 w-3"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center">
                <a href="{{ route('services.index') }}" class="bg-primary hover:bg-primary/90 text-white px-8 py-3 rounded-full font-semibold inline-flex items-center transition-colors">
                    View All Services
                    <i data-lucide="arrow-right" class="ml-2 h-4 w-4"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- About Summary -->
    <section class="py-20 bg-secondary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-4xl font-bold mb-6">
                        <span class="text-primary">
                            About B&B Tax
                        </span>
                    </h2>
                    <p class="text-lg text-muted-foreground mb-6 leading-relaxed">
                        At B&B Tax and Accounting Service Limited, we specialize in providing comprehensive 
                        accounting services tailored to the needs of small businesses across New Zealand. 
                        Our experienced team is dedicated to helping you stay compliant, organized, and focused on growing your business.
                    </p>
                    <a href="{{ route('about') }}" class="inline-flex items-center text-primary hover:text-primary/80 font-medium transition-colors">
                        Learn More About Us
                        <i data-lucide="arrow-right" class="ml-2 h-4 w-4"></i>
                    </a>
                </div>
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                         alt="Professional accounting team"
                         class="rounded-2xl shadow-xl">
                </div>
            </div>
        </div>
    </section>

    <!-- Team Summary -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-6">
                    <span class="text-primary">
                        Our Professional Team
                    </span>
                </h2>
                <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                    Meet our dedicated team of qualified professionals with years of experience 
                    helping New Zealand businesses succeed.
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-8 mb-12">
                @foreach($teamMembers as $member)
                    <div class="gradient-card hover:scale-105 transition-all duration-300 border-0 text-center bg-card rounded-xl shadow-sm">
                        <div class="p-4 sm:p-6">
                            <img src="{{ $member['image'] }}"
                                 alt="{{ $member['name'] }}"
                                 class="w-20 h-20 rounded-full object-cover mx-auto mb-4">
                            <h4 class="font-semibold text-foreground">{{ $member['name'] }}</h4>
                            <p class="text-sm text-muted-foreground">{{ $member['role'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center">
                <a href="{{ route('team') }}" class="bg-primary hover:bg-primary/90 text-white px-8 py-3 rounded-full font-semibold inline-flex items-center transition-colors">
                    Meet Our Team
                    <i data-lucide="arrow-right" class="ml-2 h-4 w-4"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Industries Summary -->
    <section class="py-20 bg-secondary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-6">
                    <span class="text-primary">
                        Industries We Serve
                    </span>
                </h2>
                <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                    Specialized accounting solutions across diverse industry sectors in New Zealand
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 sm:gap-6 mb-12">
                @foreach($industries as $industry)
                    <div class="gradient-card hover:scale-105 transition-all duration-300 group border-0 text-center bg-card rounded-xl shadow-sm">
                        <div class="p-4">
                            <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                                <i data-lucide="{{ $industry['icon'] }}" class="h-6 w-6 text-white"></i>
                            </div>
                            <h4 class="font-semibold text-foreground text-sm mb-1">{{ $industry['title'] }}</h4>
                            <p class="hidden sm:block text-xs text-muted-foreground">{{ $industry['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center">
                <a href="{{ route('industries') }}" class="border border-primary text-primary hover:bg-primary/10 px-8 py-3 rounded-full font-semibold inline-flex items-center transition-colors">
                    View All Industries
                    <i data-lucide="arrow-right" class="ml-2 h-4 w-4"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials Summary -->
    <section class="py-20 bg-secondary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-6">
                    <span class="text-primary">
                        Client Testimonials
                    </span>
                </h2>
                <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                    See what our satisfied clients have to say about our professional accounting services.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                @foreach($testimonials as $testimonial)
                    <div class="gradient-card border-0 bg-card rounded-xl shadow-sm">
                        <div class="p-8">
                            <div class="flex mb-4">
                                @for($i = 0; $i < 5; $i++)
                                    <i data-lucide="star" class="h-5 w-5 text-accent fill-current"></i>
                                @endfor
                            </div>
                            <p class="text-muted-foreground mb-4 italic">"{{ $testimonial['text'] }}"</p>
                            <div>
                                <p class="font-semibold text-foreground">{{ $testimonial['name'] }}</p>
                                <p class="text-sm text-muted-foreground">{{ $testimonial['company'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center">
                <a href="{{ route('testimonials') }}" class="border border-primary text-primary hover:bg-primary/10 px-8 py-3 rounded-full font-semibold inline-flex items-center transition-colors">
                    Read All Testimonials
                    <i data-lucide="arrow-right" class="ml-2 h-4 w-4"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Contact CTA -->
    <section class="py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="bg-primary/10 rounded-3xl p-12 border border-primary/20">
                <i data-lucide="message-square" class="h-16 w-16 text-primary mx-auto mb-6"></i>
                <h2 class="text-4xl font-bold mb-6">
                    <span class="text-primary">
                        Ready to Get Started?
                    </span>
                </h2>
                <p class="text-lg text-muted-foreground mb-8 max-w-2xl mx-auto">
                    Transform your business finances with professional accounting services. 
                    Get your free consultation today and discover how we can help your business thrive.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('contact') }}" class="bg-primary hover:bg-primary/90 text-white px-8 py-4 rounded-full text-lg font-semibold inline-flex items-center justify-center transition-colors">
                        Get Free Consultation
                        <i data-lucide="arrow-right" class="ml-2 h-5 w-5"></i>
                    </a>
                    <a href="{{ route('services.index') }}" class="border border-primary text-primary hover:bg-primary/10 px-8 py-4 rounded-full text-lg font-semibold inline-flex items-center justify-center transition-colors">
                        View Our Services
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
function heroCarousel() {
    return {
        currentSlide: 0,
        totalSlides: {{ count($heroSlides) }},
        
        init() {
            // Auto-play functionality
            setInterval(() => {
                this.nextSlide();
            }, 5000);
        },
        
        nextSlide() {
            this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
        },
        
        previousSlide() {
            this.currentSlide = this.currentSlide === 0 ? this.totalSlides - 1 : this.currentSlide - 1;
        },
        
        goToSlide(index) {
            this.currentSlide = index;
        }
    }
}
</script>
@endpush
