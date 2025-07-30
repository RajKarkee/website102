<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function index()
    {
        // For now, we'll use static data. Later you can create a Resource model
        // and pull dynamic content from the database
        $resources = [
            'guides' => [
                [
                    'title' => 'Small Business Financial Health Check',
                    'description' => 'A comprehensive guide to assessing your business\'s financial position and identifying areas for improvement.',
                    'icon' => 'trending-up',
                    'type' => 'PDF Guide',
                    'download_url' => '#'
                ],
                [
                    'title' => '2024 Tax Calendar for NZ Businesses',
                    'description' => 'Never miss a deadline with our comprehensive tax calendar showing all important dates for the year.',
                    'icon' => 'calendar',
                    'type' => 'PDF Calendar',
                    'download_url' => '#'
                ],
                [
                    'title' => 'Payroll Management Best Practices',
                    'description' => 'Learn how to manage payroll efficiently while staying compliant with New Zealand employment laws.',
                    'icon' => 'users',
                    'type' => 'PDF Guide',
                    'download_url' => '#'
                ],
                [
                    'title' => 'Xero Setup and Training Guide',
                    'description' => 'Step-by-step instructions for setting up Xero and training your team to use it effectively.',
                    'icon' => 'shield',
                    'type' => 'PDF Guide',
                    'download_url' => '#'
                ]
            ],
            'tools' => [
                [
                    'title' => 'GST Calculator',
                    'description' => 'Calculate GST amounts quickly and accurately.',
                    'url' => '#'
                ],
                [
                    'title' => 'Payroll Calculator',
                    'description' => 'Calculate employee wages, PAYE, and other deductions.',
                    'url' => '#'
                ],
                [
                    'title' => 'Cash Flow Planner',
                    'description' => 'Plan and forecast your business cash flow.',
                    'url' => '#'
                ]
            ]
        ];
        
        return view('resources', compact('resources'));
    }
}
