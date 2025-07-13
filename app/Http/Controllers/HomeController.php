<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $heroSlides = [
            [
                'title' => 'Uncover business value in volatility with B&B Tax',
                'subtitle' => '',
                'description' => 'Our audit, tax, and consulting specialists help organizations like yours navigate today\'s accelerating rate of change.',
                'backgroundImage' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80',
                'image' => '/images/183a6bc8-df45-4d4c-b13d-a992110190ac.png',
                'features' => [
                    ['icon' => 'check-circle', 'text' => '15+ Years Experience'],
                    ['icon' => 'trending-up', 'text' => '500+ Happy Clients'],
                    ['icon' => 'sparkles', 'text' => 'Complete Solutions'],
                    ['icon' => 'check-circle', 'text' => '100% IRD Compliant']
                ]
            ],
            [
                'title' => 'Professional Tax Excellence for New Zealand Businesses',
                'subtitle' => '',
                'description' => 'Navigate complex tax requirements with confidence. Our qualified professionals provide strategic tax planning and compliance services to optimize your business performance.',
                'backgroundImage' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80',
                'image' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80',
                'features' => [
                    ['icon' => 'calculator', 'text' => 'Strategic Tax Planning'],
                    ['icon' => 'file-text', 'text' => 'GST & PAYE Filing'],
                    ['icon' => 'shield', 'text' => 'Audit Protection'],
                    ['icon' => 'trending-up', 'text' => 'Tax Optimization']
                ]
            ],
            [
                'title' => 'Transform your financial management with digital solutions',
                'subtitle' => '',
                'description' => 'Leverage cutting-edge cloud technology and real-time insights to streamline operations, enhance accuracy, and drive informed business decisions.',
                'backgroundImage' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80',
                'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80',
                'features' => [
                    ['icon' => 'zap', 'text' => 'Cloud-Based Systems'],
                    ['icon' => 'book-open', 'text' => 'Real-Time Reporting'],
                    ['icon' => 'users', 'text' => '24/7 Access'],
                    ['icon' => 'dollar-sign', 'text' => 'Cost-Effective']
                ]
            ]
        ];

        $services = [
            ['icon' => 'users', 'title' => 'Payroll Management', 'desc' => 'Accurate payroll processing and KiwiSaver compliance', 'link' => 'services.payroll-management'],
            ['icon' => 'file-text', 'title' => 'Accounts Receivable', 'desc' => 'Invoice management and payment follow-up', 'link' => 'services.accounts-receivable'],
            ['icon' => 'credit-card', 'title' => 'Accounts Payable', 'desc' => 'Supplier invoice and payment management', 'link' => 'services.accounts-payable'],
            ['icon' => 'dollar-sign', 'title' => 'Credit Control', 'desc' => 'Debt monitoring and cash collection', 'link' => 'services.credit-control'],
            ['icon' => 'trending-up', 'title' => 'Payroll Data Entry', 'desc' => 'Fast and accurate payroll data processing', 'link' => 'services.payroll-data-entry'],
            ['icon' => 'building', 'title' => 'GST Filing', 'desc' => 'GST returns and IRD compliance', 'link' => 'services.gst-filing'],
            ['icon' => 'zap', 'title' => 'PAYE Services', 'desc' => 'PAYE calculations and IRD payments', 'link' => 'services.paye-services'],
            ['icon' => 'book-open', 'title' => 'Income Tax Returns', 'desc' => 'Tax return preparation and filing', 'link' => 'services.income-tax-returns'],
            ['icon' => 'graduation-cap', 'title' => 'Xero Training', 'desc' => 'Comprehensive Xero system training', 'link' => 'services.xero-training']
        ];

        $teamMembers = [
            ['name' => 'Sarah Chen', 'role' => 'Senior Accountant', 'image' => 'https://images.unsplash.com/photo-1494790108755-2616c898834c?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80'],
            ['name' => 'Marcus Rodriguez', 'role' => 'Payroll Specialist', 'image' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80'],
            ['name' => 'Emma Thompson', 'role' => 'Business Advisor', 'image' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80'],
            ['name' => 'David Kim', 'role' => 'Compliance Manager', 'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80']
        ];

        $industries = [
            ['icon' => 'building', 'title' => 'Construction', 'desc' => 'Project accounting and compliance'],
            ['icon' => 'users', 'title' => 'Professional Services', 'desc' => 'Consultancy and advisory firms'],
            ['icon' => 'zap', 'title' => 'Technology', 'desc' => 'Startups and tech companies'],
            ['icon' => 'dollar-sign', 'title' => 'Retail', 'desc' => 'Point of sale and inventory management'],
            ['icon' => 'file-text', 'title' => 'Healthcare', 'desc' => 'Medical practice accounting'],
            ['icon' => 'trending-up', 'title' => 'Manufacturing', 'desc' => 'Cost accounting and operations']
        ];

        $testimonials = [
            ['name' => 'Michael Thompson', 'company' => 'Thompson Construction', 'text' => 'Professional service that saved us countless hours and stress.'],
            ['name' => 'Sarah Mitchell', 'company' => 'Mitchell Marketing', 'text' => 'Exceptional team that helped streamline our financial processes.']
        ];

        return view('home', compact('heroSlides', 'services', 'teamMembers', 'industries', 'testimonials'));
    }
}
