@extends('layouts.app')

@section('title', 'Industries We Serve - B&B Tax')
@section('meta_description',
    'B&B Tax provides specialized accounting services across diverse industries in New Zealand
    including construction, healthcare, technology, and more.')

@section('content')
    <div class="min-h-screen bg-background text-foreground">

        <!-- Jumbotron -->
        @include('components.jumbotron', [
            'title' => 'Industries We Serve',
            'subtitle' => 'Specialized Solutions Across Sectors',
            'description' =>
                'We understand the unique accounting challenges of different industries and provide tailored solutions to meet your specific needs.',
            'backgroundImage' =>
                'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80',
            'icon' => '<i data-lucide="building-2" class="h-5 w-5 text-yellow-400"></i>',
            'badge' => 'Industry Expertise',
        ])

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                @php
                    $industries = [
                        [
                            'icon' => 'hammer',
                            'title' => 'Construction & Trades',
                            'description' =>
                                'Project accounting, progress billing, subcontractor management, and compliance with industry-specific regulations.',
                            'services' => [
                                'Project costing',
                                'Progress billing',
                                'WIP accounting',
                                'Subcontractor payments',
                            ],
                        ],
                        [
                            'icon' => 'stethoscope',
                            'title' => 'Healthcare & Medical',
                            'description' =>
                                'Practice management, patient billing systems, professional indemnity, and healthcare-specific compliance requirements.',
                            'services' => [
                                'Practice accounting',
                                'Patient billing',
                                'Insurance claims',
                                'Compliance reporting',
                            ],
                        ],
                        [
                            'icon' => 'cpu',
                            'title' => 'Technology & IT',
                            'description' =>
                                'R&D tax credits, software revenue recognition, intellectual property management, and startup financial planning.',
                            'services' => [
                                'R&D tax credits',
                                'Revenue recognition',
                                'IP accounting',
                                'Startup support',
                            ],
                        ],
                        [
                            'icon' => 'shopping-cart',
                            'title' => 'Retail & E-commerce',
                            'description' =>
                                'Inventory management, point of sale integration, multi-channel sales tracking, and seasonal cash flow planning.',
                            'services' => [
                                'Inventory tracking',
                                'POS integration',
                                'Sales analysis',
                                'Cash flow planning',
                            ],
                        ],
                        [
                            'icon' => 'users',
                            'title' => 'Professional Services',
                            'description' =>
                                'Time-based billing, project profitability, trust account management, and professional liability considerations.',
                            'services' => [
                                'Time billing',
                                'Project tracking',
                                'Trust accounts',
                                'Profitability analysis',
                            ],
                        ],
                        [
                            'icon' => 'cog',
                            'title' => 'Manufacturing',
                            'description' =>
                                'Cost accounting, inventory valuation, production planning, and supply chain financial management.',
                            'services' => [
                                'Cost accounting',
                                'Inventory valuation',
                                'Production costing',
                                'Supply chain finance',
                            ],
                        ],
                        [
                            'icon' => 'home',
                            'title' => 'Real Estate & Property',
                            'description' =>
                                'Property management accounting, rental income tracking, depreciation schedules, and investment analysis.',
                            'services' => [
                                'Property accounting',
                                'Rental tracking',
                                'Depreciation',
                                'Investment analysis',
                            ],
                        ],
                        [
                            'icon' => 'utensils',
                            'title' => 'Hospitality & Tourism',
                            'description' =>
                                'Restaurant accounting, tourism operator compliance, seasonal business planning, and cash management.',
                            'services' => [
                                'Restaurant accounting',
                                'Tourism compliance',
                                'Seasonal planning',
                                'Cash management',
                            ],
                        ],
                        [
                            'icon' => 'truck',
                            'title' => 'Transport & Logistics',
                            'description' =>
                                'Fleet management, fuel tax credits, driver contractor arrangements, and route profitability analysis.',
                            'services' => [
                                'Fleet accounting',
                                'Fuel tax credits',
                                'Contractor management',
                                'Route analysis',
                            ],
                        ],
                    ];
                @endphp

                @foreach ($industryData as $industry)
                    <div
                        class="gradient-card p-6 border-0 rounded-xl shadow-sm hover:scale-105 transition-all duration-300 group h-full flex flex-col">
                        <div
                            class="w-14 h-14 bg-primary rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <i data-lucide="{{ $industry['icon'] }}" class="h-7 w-7 text-white"></i>
                        </div>

                        <h3 class="text-xl font-semibold text-foreground mb-3 group-hover:text-primary transition-colors">
                            {{ $industry['title'] }}
                        </h3>

                        <p class="text-muted-foreground mb-4 flex-grow">
                            {{ $industry['description'] }}
                        </p>

                        <div class="space-y-2">
                            <h4 class="font-medium text-foreground text-sm">Key Services:</h4>
                            <ul class="text-sm text-muted-foreground space-y-1">
                                @foreach ($industry['services'] as $service)
                                    <li class="flex items-center">
                                        <i data-lucide="check" class="h-3 w-3 text-green-600 mr-2 flex-shrink-0"></i>
                                        {{ $service }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>

            @include('components.values');
            <!-- Industry Expertise Section -->
            {{-- <div class="mb-16">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold mb-4 text-primary">
                        Why Industry Expertise Matters
                    </h2>
                    <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                        Every industry has unique accounting challenges. Our specialized knowledge ensures compliance and
                        optimization.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @php
                        $benefits = [
                            [
                                'icon' => 'shield-check',
                                'title' => 'Regulatory Compliance',
                                'description' =>
                                    'Deep understanding of industry-specific regulations and compliance requirements.',
                            ],
                            [
                                'icon' => 'trending-up',
                                'title' => 'Performance Benchmarking',
                                'description' =>
                                    'Compare your performance against industry standards and best practices.',
                            ],
                            [
                                'icon' => 'lightbulb',
                                'title' => 'Strategic Insights',
                                'description' =>
                                    'Industry-focused advice to help you make informed business decisions.',
                            ],
                        ];
                    @endphp

                    @foreach ($benefits as $benefit)
                        <div class="text-center p-6">
                            <div class="w-16 h-16 bg-primary rounded-xl flex items-center justify-center mx-auto mb-4">
                                <i data-lucide="{{ $benefit['icon'] }}" class="h-8 w-8 text-white"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-foreground mb-3">{{ $benefit['title'] }}</h3>
                            <p class="text-muted-foreground">{{ $benefit['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div> --}}

            <!-- Call to Action -->
            @php
                $cta = \App\Models\Cta::where('page', 'industries')->first();
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
