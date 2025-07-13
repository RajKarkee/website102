@extends('layouts.app')

@section('title', 'Payroll Management Services - B&B Tax')
@section('meta_description', 'Professional payroll management services including payslip preparation, leave management, and KiwiSaver compliance for New Zealand businesses.')

@section('content')
<div class="min-h-screen bg-background text-foreground">
    
    <!-- Jumbotron -->
    @include('components.jumbotron', [
        'title' => 'Payroll Management',
        'subtitle' => 'Accurate & Compliant Payroll Processing',
        'description' => 'Comprehensive payroll services ensuring your employees are paid correctly and on time, with full compliance to New Zealand employment laws.',
        'backgroundImage' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80',
        'icon' => '<i data-lucide="users" class="h-5 w-5 text-yellow-400"></i>',
        'badge' => 'Payroll Services'
    ])

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Service Overview -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-20">
            <div>
                <h2 class="text-3xl font-bold mb-6 text-primary">
                    Professional Payroll Management
                </h2>
                <p class="text-lg text-muted-foreground mb-6 leading-relaxed">
                    Our payroll management service takes the complexity out of paying your employees. 
                    We handle everything from calculating wages and deductions to ensuring compliance 
                    with IRD requirements and employment legislation.
                </p>
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <i data-lucide="check-circle" class="h-6 w-6 text-green-600 mt-0.5 flex-shrink-0"></i>
                        <div>
                            <h4 class="font-semibold text-foreground">PAYE & Tax Calculations</h4>
                            <p class="text-muted-foreground">Accurate calculation of PAYE, ACC, and other deductions</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <i data-lucide="check-circle" class="h-6 w-6 text-green-600 mt-0.5 flex-shrink-0"></i>
                        <div>
                            <h4 class="font-semibold text-foreground">KiwiSaver Management</h4>
                            <p class="text-muted-foreground">Complete KiwiSaver administration and compliance</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <i data-lucide="check-circle" class="h-6 w-6 text-green-600 mt-0.5 flex-shrink-0"></i>
                        <div>
                            <h4 class="font-semibold text-foreground">Leave Management</h4>
                            <p class="text-muted-foreground">Annual leave, sick leave, and statutory holiday calculations</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                     alt="Payroll management services"
                     class="rounded-2xl shadow-xl">
            </div>
        </div>

        <!-- Features Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            @php
                $features = [
                    [
                        'icon' => 'calculator',
                        'title' => 'Accurate Calculations',
                        'description' => 'Precise wage calculations including overtime, allowances, and deductions'
                    ],
                    [
                        'icon' => 'file-text',
                        'title' => 'Payslip Generation',
                        'description' => 'Professional payslips with detailed breakdown of earnings and deductions'
                    ],
                    [
                        'icon' => 'shield',
                        'title' => 'IRD Compliance',
                        'description' => 'Full compliance with IRD requirements and employment legislation'
                    ],
                    [
                        'icon' => 'clock',
                        'title' => 'Timely Processing',
                        'description' => 'Guaranteed on-time payroll processing every pay period'
                    ],
                    [
                        'icon' => 'database',
                        'title' => 'Secure Records',
                        'description' => 'Secure storage and management of all payroll records'
                    ],
                    [
                        'icon' => 'phone',
                        'title' => 'Expert Support',
                        'description' => 'Dedicated support for all your payroll queries and issues'
                    ]
                ];
            @endphp

            @foreach($features as $feature)
                <div class="gradient-card p-6 text-center border-0 rounded-xl shadow-sm">
                    <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="{{ $feature['icon'] }}" class="h-6 w-6 text-white"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-foreground mb-2">{{ $feature['title'] }}</h3>
                    <p class="text-muted-foreground">{{ $feature['description'] }}</p>
                </div>
            @endforeach
        </div>

        <!-- Pricing Section -->
        <div class="text-center bg-primary/10 rounded-3xl p-12 border border-primary/20 mb-16">
            <h2 class="text-3xl font-bold mb-6 text-primary">
                Affordable Payroll Solutions
            </h2>
            <p class="text-lg text-muted-foreground mb-8 max-w-2xl mx-auto">
                Our payroll management services start from just $50 per month for small businesses. 
                Contact us for a customized quote based on your specific needs.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact') }}" 
                   class="bg-primary hover:bg-primary/90 text-white px-8 py-4 rounded-full text-lg font-semibold inline-flex items-center justify-center transition-colors">
                    Get Quote
                    <i data-lucide="arrow-right" class="ml-2 h-5 w-5"></i>
                </a>
                <a href="{{ route('services.index') }}" 
                   class="border border-primary text-primary hover:bg-primary/10 px-8 py-4 rounded-full text-lg font-semibold inline-flex items-center justify-center transition-colors">
                    View All Services
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
