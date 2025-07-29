@extends('layouts.app')

@section('title', 'Our Services - B&B Tax Accounting Services')
@section('meta_description',
    'Professional accounting services including payroll management, GST filing, tax returns,
    and Xero training for New Zealand businesses.')
 
@section('content')
    <div class="min-h-screen bg-background text-foreground">

        <!-- Jumbotron -->
        @include('components.jumbotron', [
            'title' => 'Our Services',
            'subtitle' => 'Comprehensive Accounting Solutions',
            'description' =>
                'Professional accounting services tailored for New Zealand businesses. From payroll management to tax compliance, we\'ve got you covered.',
            'backgroundImage' =>
                'https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80',
            'icon' => '<i data-lucide="sparkles" class="h-5 w-5 text-yellow-400"></i>',
            'badge' => 'Professional Services',
        ])

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-8 mb-16">
                @foreach ($services as $service)
                    <div
                        class="gradient-card hover:scale-105 transition-all duration-300 group border-0 overflow-hidden h-full flex flex-col bg-card rounded-xl shadow-sm">
                        <div class="p-6 relative">
                            <div
                                class="w-14 h-14 {{ $service['color']}} rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform shadow-lg">
                                <img src="{{ asset('storage/' . $service['icon']) }}" alt="service">
                            </div>
                            <div
                                class="absolute -top-2 -right-2 w-20 h-20 {{ $service['color'] }} rounded-full opacity-10 group-hover:scale-150 transition-transform duration-500">
                            </div>
                            <h3 class="text-xl text-foreground group-hover:text-primary transition-colors mb-4">
                                {{ $service['title'] }}
                            </h3>
                            <p class="text-muted-foreground leading-relaxed mb-6 flex-grow">
                                {{ $service['description'] }}
                            </p>
                            <div class="flex justify-between items-center mt-auto">
                                <a href="#"
                                    class="inline-flex items-center text-primary hover:text-primary/80 font-medium transition-colors">
                                    Learn More
                                    <i data-lucide="arrow-right" class="ml-2 h-4 w-4"></i>
                                </a>
                                <div
                                    class="w-8 h-8 {{ $service['color'] }} rounded-lg flex items-center justify-center opacity-20 group-hover:opacity-100 transition-opacity">
                                    <img src="{{ asset('storage/' . $service['icon']) }}" class="h-4 w-4 text-white">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Dynamic CTA -->
            @php
                $cta = \App\Models\Cta::where('page', 'services')->first();
            @endphp
            @if ($cta)
                @include('components.cta', [
                    'icon' => $cta->icon ?? 'target',
                    'title' => $cta->title,
                    'description' => $cta->description,
                    'button1_text' => $cta->button1_text,
                    'button2_text' => $cta->button2_text,
                ])
            @endif
        </div>
    </div>
@endsection
