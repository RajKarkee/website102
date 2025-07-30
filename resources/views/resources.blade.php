@extends('layouts.app')

@section('title', 'Resources & Guides - B&B Tax')
@section('meta_description', 'Access helpful accounting resources, tax guides, and business tools for New Zealand businesses. Free downloads and expert insights.')

@section('content')
    <div class="min-h-screen bg-background text-foreground">

        <!-- Jumbotron -->
        @include('components.jumbotron', [
            'title' => 'Resources & Guides',
            'subtitle' => 'Knowledge Hub for Your Business',
            'description' => 'Access our comprehensive collection of accounting guides, tax resources, and business tools designed to help New Zealand businesses succeed.',
            'backgroundImage' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80',
            'icon' => '<i data-lucide="book-open" class="h-5 w-5 text-yellow-400"></i>',
            'badge' => 'Knowledge Center',
        ])

        <!-- Resources Section -->
        <section class="py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <!-- Resource Categories -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                    
                    <!-- Tax Guides -->
                    <div class="gradient-card hover:scale-105 transition-all duration-300 group border-0 overflow-hidden bg-card rounded-xl shadow-sm">
                        <div class="p-8">
                            <div class="w-16 h-16 bg-primary rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                <i data-lucide="file-text" class="h-8 w-8 text-white"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-foreground mb-4">Tax Guides</h3>
                            <p class="text-muted-foreground leading-relaxed mb-6">
                                Comprehensive guides on New Zealand tax obligations, deductions, and compliance requirements for businesses.
                            </p>
                            <div class="space-y-3">
                                <div class="flex items-center text-sm text-muted-foreground">
                                    <i data-lucide="check-circle" class="h-4 w-4 text-primary mr-2"></i>
                                    GST Filing Requirements
                                </div>
                                <div class="flex items-center text-sm text-muted-foreground">
                                    <i data-lucide="check-circle" class="h-4 w-4 text-primary mr-2"></i>
                                    Income Tax Returns
                                </div>
                                <div class="flex items-center text-sm text-muted-foreground">
                                    <i data-lucide="check-circle" class="h-4 w-4 text-primary mr-2"></i>
                                    PAYE Compliance
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Business Tools -->
                    <div class="gradient-card hover:scale-105 transition-all duration-300 group border-0 overflow-hidden bg-card rounded-xl shadow-sm">
                        <div class="p-8">
                            <div class="w-16 h-16 bg-primary rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                <i data-lucide="calculator" class="h-8 w-8 text-white"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-foreground mb-4">Business Tools</h3>
                            <p class="text-muted-foreground leading-relaxed mb-6">
                                Free calculators and tools to help you manage your finances and make informed business decisions.
                            </p>
                            <div class="space-y-3">
                                <div class="flex items-center text-sm text-muted-foreground">
                                    <i data-lucide="check-circle" class="h-4 w-4 text-primary mr-2"></i>
                                    GST Calculator
                                </div>
                                <div class="flex items-center text-sm text-muted-foreground">
                                    <i data-lucide="check-circle" class="h-4 w-4 text-primary mr-2"></i>
                                    Payroll Calculator
                                </div>
                                <div class="flex items-center text-sm text-muted-foreground">
                                    <i data-lucide="check-circle" class="h-4 w-4 text-primary mr-2"></i>
                                    Cash Flow Planner
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Templates -->
                    <div class="gradient-card hover:scale-105 transition-all duration-300 group border-0 overflow-hidden bg-card rounded-xl shadow-sm">
                        <div class="p-8">
                            <div class="w-16 h-16 bg-primary rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                <i data-lucide="download" class="h-8 w-8 text-white"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-foreground mb-4">Templates & Forms</h3>
                            <p class="text-muted-foreground leading-relaxed mb-6">
                                Ready-to-use templates and forms to streamline your accounting and business processes.
                            </p>
                            <div class="space-y-3">
                                <div class="flex items-center text-sm text-muted-foreground">
                                    <i data-lucide="check-circle" class="h-4 w-4 text-primary mr-2"></i>
                                    Invoice Templates
                                </div>
                                <div class="flex items-center text-sm text-muted-foreground">
                                    <i data-lucide="check-circle" class="h-4 w-4 text-primary mr-2"></i>
                                    Expense Tracking
                                </div>
                                <div class="flex items-center text-sm text-muted-foreground">
                                    <i data-lucide="check-circle" class="h-4 w-4 text-primary mr-2"></i>
                                    Budget Planners
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Featured Resources -->
                <div class="mb-16">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold mb-4 text-primary">Featured Resources</h2>
                        <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                            Our most popular guides and tools to help your business thrive
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Resource Item 1 -->
                        <div class="bg-card rounded-xl shadow-sm border border-border p-8 hover:shadow-lg transition-shadow">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="trending-up" class="h-6 w-6 text-primary"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-foreground mb-2">
                                        Small Business Financial Health Check
                                    </h3>
                                    <p class="text-muted-foreground text-sm mb-4">
                                        A comprehensive guide to assessing your business's financial position and identifying areas for improvement.
                                    </p>
                                    <div class="flex items-center text-sm text-primary">
                                        <i data-lucide="download" class="h-4 w-4 mr-2"></i>
                                        Download PDF
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Resource Item 2 -->
                        <div class="bg-card rounded-xl shadow-sm border border-border p-8 hover:shadow-lg transition-shadow">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="calendar" class="h-6 w-6 text-primary"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-foreground mb-2">
                                        2024 Tax Calendar for NZ Businesses
                                    </h3>
                                    <p class="text-muted-foreground text-sm mb-4">
                                        Never miss a deadline with our comprehensive tax calendar showing all important dates for the year.
                                    </p>
                                    <div class="flex items-center text-sm text-primary">
                                        <i data-lucide="download" class="h-4 w-4 mr-2"></i>
                                        Download PDF
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Resource Item 3 -->
                        <div class="bg-card rounded-xl shadow-sm border border-border p-8 hover:shadow-lg transition-shadow">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="users" class="h-6 w-6 text-primary"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-foreground mb-2">
                                        Payroll Management Best Practices
                                    </h3>
                                    <p class="text-muted-foreground text-sm mb-4">
                                        Learn how to manage payroll efficiently while staying compliant with New Zealand employment laws.
                                    </p>
                                    <div class="flex items-center text-sm text-primary">
                                        <i data-lucide="download" class="h-4 w-4 mr-2"></i>
                                        Download PDF
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Resource Item 4 -->
                        <div class="bg-card rounded-xl shadow-sm border border-border p-8 hover:shadow-lg transition-shadow">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="shield" class="h-6 w-6 text-primary"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-foreground mb-2">
                                        Xero Setup and Training Guide
                                    </h3>
                                    <p class="text-muted-foreground text-sm mb-4">
                                        Step-by-step instructions for setting up Xero and training your team to use it effectively.
                                    </p>
                                    <div class="flex items-center text-sm text-primary">
                                        <i data-lucide="download" class="h-4 w-4 mr-2"></i>
                                        Download PDF
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FAQ Section -->
                <div class="bg-secondary rounded-3xl p-12 mb-16">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold mb-4 text-primary">Frequently Asked Questions</h2>
                        <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                            Quick answers to common accounting and tax questions
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="font-semibold text-foreground mb-2">When is GST filing due?</h3>
                            <p class="text-muted-foreground text-sm mb-4">
                                GST returns are due on the 28th of the month following the end of your taxable period. For example, if your period ends on March 31, your return is due April 28.
                            </p>
                        </div>

                        <div>
                            <h3 class="font-semibold text-foreground mb-2">What records should I keep?</h3>
                            <p class="text-muted-foreground text-sm mb-4">
                                Keep all invoices, receipts, bank statements, and payroll records for at least 7 years. Digital copies are acceptable if they're clear and complete.
                            </p>
                        </div>

                        <div>
                            <h3 class="font-semibold text-foreground mb-2">How often should I reconcile accounts?</h3>
                            <p class="text-muted-foreground text-sm mb-4">
                                We recommend monthly reconciliation for most businesses, though some may benefit from weekly reconciliation for better cash flow management.
                            </p>
                        </div>

                        <div>
                            <h3 class="font-semibold text-foreground mb-2">What expenses are tax deductible?</h3>
                            <p class="text-muted-foreground text-sm mb-4">
                                Business expenses that are directly related to earning income are generally deductible. This includes office supplies, professional fees, and business travel.
                            </p>
                        </div>
                    </div>

                    <div class="text-center mt-8">
                        <a href="{{ route('contact') }}" 
                           class="border border-primary text-primary hover:bg-primary/10 px-6 py-3 rounded-full font-semibold inline-flex items-center transition-colors">
                            Ask a Question
                            <i data-lucide="arrow-right" class="ml-2 h-4 w-4"></i>
                        </a>
                    </div>
                </div>

                <!-- Newsletter Signup -->
                <div class="bg-primary/10 rounded-3xl p-12 border border-primary/20">
                    <div class="text-center mb-8">
                        <i data-lucide="mail" class="h-16 w-16 text-primary mx-auto mb-6"></i>
                        <h2 class="text-3xl font-bold text-foreground mb-4">Stay Updated</h2>
                        <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                            Subscribe to our newsletter for the latest tax updates, business tips, and exclusive resources delivered to your inbox.
                        </p>
                    </div>

                    <form class="max-w-md mx-auto flex gap-4">
                        <input type="email" 
                               placeholder="Enter your email address" 
                               class="flex-1 px-4 py-3 rounded-full border border-border bg-background text-foreground placeholder-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary">
                        <button type="submit" 
                                class="bg-primary hover:bg-primary/90 text-white px-6 py-3 rounded-full font-semibold transition-colors">
                            Subscribe
                        </button>
                    </form>

                    <p class="text-xs text-muted-foreground text-center mt-4">
                        No spam, unsubscribe at any time. Read our <a href="#" class="text-primary hover:underline">privacy policy</a>.
                    </p>
                </div>

                <!-- CTA Section -->
                @php
                    $cta = \App\Models\Cta::where('page', 'resources')->first();
                @endphp
                @if ($cta)
                    <div class="text-center bg-card rounded-3xl p-12 border border-border mt-16">
                        <i data-lucide="{{ $cta->icon ?? 'book-open' }}" class="h-16 w-16 text-primary mx-auto mb-6"></i>
                        @include('components.cta', [
                            'icon' => $cta->icon ?? 'book-open',
                            'title' => $cta->title,
                            'description' => $cta->description,
                            'button1_text' => $cta->button1_text,
                            'button2_text' => $cta->button2_text,
                        ])
                    </div>
                @else
                    <div class="text-center bg-card rounded-3xl p-12 border border-border mt-16">
                        <i data-lucide="phone" class="h-16 w-16 text-primary mx-auto mb-6"></i>
                        <h2 class="text-3xl font-bold text-foreground mb-4">Need Personalized Advice?</h2>
                        <p class="text-lg text-muted-foreground mb-8 max-w-2xl mx-auto">
                            While our resources are comprehensive, every business is unique. Contact us for personalized advice tailored to your specific situation.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="{{ route('contact') }}" 
                               class="bg-primary hover:bg-primary/90 text-white px-8 py-4 rounded-full font-semibold inline-flex items-center justify-center transition-colors">
                                Get Professional Advice
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
