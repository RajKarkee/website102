@extends('layouts.app')

@section('title', 'Contact Us - B&B Tax Accounting Services')
@section('meta_description', 'Get in touch with B&B Tax for professional accounting services. Located in Auckland,
    serving businesses across New Zealand.')

@section('content')
    <div class="min-h-screen bg-background text-foreground">

        <!-- Jumbotron -->
        @include('components.jumbotron', [
            'title' => 'Contactt Us',
            'subtitle' => 'Get in Touch Today',
            'description' =>
                'Ready to streamline your accounting? Contact our team of professionals and discover how we can help your business thrive.',
            'backgroundImage' =>
                'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80',
            'icon' => '<i data-lucide="mail" class="h-5 w-5 text-yellow-400"></i>',
            'badge' => 'Contact Information',
        ])

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

            @if (session('success'))
                <div class="alert-success mb-8 rounded-lg p-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <!-- Contact Form -->
                <div>
                    <h2 class="text-3xl font-bold mb-6 text-primary">
                        Send us a Message
                    </h2>
                    <p class="text-lg text-muted-foreground mb-8">
                        Fill out the form below and we'll get back to you within 24 hours.
                    </p>

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6" data-validate>
                        @csrf

                        <div class="form-group">
                            <label for="name" class="block text-sm font-medium text-foreground mb-2">
                                Full Name *
                            </label>
                            <input type="text" id="name" name="name" required value="{{ old('name') }}"
                                class="form-input" placeholder="Enter your full name">
                            @error('name')
                                <div class="error-message text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="block text-sm font-medium text-foreground mb-2">
                                Email Address *
                            </label>
                            <input type="email" id="email" name="email" required value="{{ old('email') }}"
                                class="form-input" placeholder="Enter your email address">
                            @error('email')
                                <div class="error-message text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone" class="block text-sm font-medium text-foreground mb-2">
                                Phone Number
                            </label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                class="form-input" placeholder="Enter your phone number">
                            @error('phone')
                                <div class="error-message text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="service" class="block text-sm font-medium text-foreground mb-2">
                                Service Interest
                            </label>
                            <select id="service" name="service" class="form-input">
                                <option value="">Select a service</option>
                                <option value="payroll-management"
                                    {{ old('service') == 'payroll-management' ? 'selected' : '' }}>Payroll Management
                                </option>
                                <option value="accounts-receivable"
                                    {{ old('service') == 'accounts-receivable' ? 'selected' : '' }}>Accounts Receivable
                                </option>
                                <option value="accounts-payable"
                                    {{ old('service') == 'accounts-payable' ? 'selected' : '' }}>Accounts Payable</option>
                                <option value="gst-filing" {{ old('service') == 'gst-filing' ? 'selected' : '' }}>GST
                                    Filing</option>
                                <option value="tax-returns" {{ old('service') == 'tax-returns' ? 'selected' : '' }}>Tax
                                    Returns</option>
                                <option value="xero-training" {{ old('service') == 'xero-training' ? 'selected' : '' }}>
                                    Xero Training</option>
                                <option value="other" {{ old('service') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('service')
                                <div class="error-message text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="message" class="block text-sm font-medium text-foreground mb-2">
                                Message *
                            </label>
                            <textarea id="message" name="message" required class="form-textarea"
                                placeholder="Tell us about your accounting needs...">{{ old('message') }}</textarea>
                            @error('message')
                                <div class="error-message text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn-primary w-full">
                            <i data-lucide="send" class="mr-2 h-5 w-5"></i>
                            Send Message
                        </button>
                    </form>
                </div>

                <!-- Contact Information -->
                <div>
                    <h2 class="text-3xl font-bold mb-6 text-primary">
                        Get in Touch
                    </h2>
                    <p class="text-lg text-muted-foreground mb-8">
                        We're here to help with all your accounting needs. Reach out through any of the channels below.
                    </p>

                    <div class="space-y-6 mb-12">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i data-lucide="map-pin" class="h-6 w-6 text-white"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-foreground mb-1">Office Address</h3>
                                <p class="text-muted-foreground">
                                    Level 15, Innovation Tower<br>
                                    123 Queen Street<br>
                                    Auckland 1010, New Zealand
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-green-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i data-lucide="phone" class="h-6 w-6 text-white"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-foreground mb-1">Phone</h3>
                                <p class="text-muted-foreground">
                                    <a href="tel:+6491234567" class="hover:text-primary transition-colors">
                                        +64 9 123 4567
                                    </a>
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-purple-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i data-lucide="mail" class="h-6 w-6 text-white"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-foreground mb-1">Email</h3>
                                <p class="text-muted-foreground">
                                    <a href="mailto:hello@bnbtax.nz" class="hover:text-primary transition-colors">
                                        hello@bnbtax.nz
                                    </a>
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-orange-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i data-lucide="clock" class="h-6 w-6 text-white"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-foreground mb-1">Business Hours</h3>
                                <p class="text-muted-foreground">
                                    Monday - Friday: 9:00 AM - 5:30 PM<br>
                                    Saturday: 9:00 AM - 1:00 PM<br>
                                    Sunday: Closed
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Google Map Placeholder -->
                    <div class="bg-muted rounded-xl p-8 text-center">
                        <i data-lucide="map" class="h-16 w-16 text-muted-foreground mx-auto mb-4"></i>
                        <h3 class="text-lg font-semibold text-foreground mb-2">Interactive Map</h3>
                        <p class="text-muted-foreground mb-4">
                            Find us easily in the heart of Auckland's business district
                        </p>
                        <button class="btn-secondary">
                            <i data-lucide="navigation" class="mr-2 h-4 w-4"></i>
                            Get Directions
                        </button>
                    </div>
                </div>
            </div>

            <!-- FAQ Section -->
            <div class="mt-20">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold mb-4 text-primary">
                        Frequently Asked Questions
                    </h2>
                    <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                        Quick answers to common questions about our accounting services
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @php
                        $faqs = [
                            [
                                'question' => 'How quickly can you start managing our payroll?',
                                'answer' =>
                                    'We can typically start managing your payroll within 1-2 business days of receiving all necessary information and documentation.',
                            ],
                            [
                                'question' => 'Do you work with businesses outside Auckland?',
                                'answer' =>
                                    'Yes, we work with businesses throughout New Zealand. Most of our services can be provided remotely via secure cloud-based systems.',
                            ],
                            [
                                'question' => 'What accounting software do you support?',
                                'answer' =>
                                    'We primarily work with Xero, MYOB, and QuickBooks. We also provide comprehensive training on these platforms.',
                            ],
                            [
                                'question' => 'How do you ensure data security?',
                                'answer' =>
                                    'We use bank-level encryption and secure cloud storage. All our systems are regularly updated and comply with New Zealand privacy laws.',
                            ],
                        ];
                    @endphp

                    @foreach ($faqs as $faq)
                        <div class="gradient-card p-6 border-0 rounded-xl shadow-sm">
                            <h3 class="text-lg font-semibold text-foreground mb-3">{{ $faq['question'] }}</h3>
                            <p class="text-muted-foreground">{{ $faq['answer'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
