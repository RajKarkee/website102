<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'icon' => 'users',
                'title' => 'Payroll Management',
                'description' => 'Accurate payroll processing, payslip preparation, leave management, and KiwiSaver compliance, ensuring your employees are paid correctly and on time.',
                'long_description' => 'Our comprehensive payroll management service ensures that your employees are paid accurately and on time. We handle all aspects of payroll processing including calculating wages, deductions, leave entitlements, and KiwiSaver contributions.',
                'points' => json_encode([
                    'Accurate payroll calculations',
                    'Payslip generation and distribution',
                    'Leave management tracking',
                    'KiwiSaver compliance',
                    'PAYE calculations and payments'
                ]),
                'points_description' => json_encode([
                    'We ensure all payroll calculations are precise and compliant',
                    'Professional payslips delivered to employees',
                    'Complete leave tracking and management system',
                    'Full KiwiSaver compliance and reporting',
                    'Accurate PAYE calculations and timely payments'
                ])
            ],
            [
                'icon' => 'file-text',
                'title' => 'Accounts Receivable (AR)',
                'description' => 'We manage your invoicing, follow up on outstanding payments, and help maintain a healthy cash flow for your business.',
                'long_description' => 'Our accounts receivable service helps you maintain steady cash flow by managing your customer invoices and payments efficiently.',
                'points' => json_encode([
                    'Invoice generation and dispatch',
                    'Payment tracking and reconciliation',
                    'Overdue payment follow-ups',
                    'Customer account management',
                    'Cash flow reporting'
                ]),
                'points_description' => json_encode([
                    'Professional invoice creation and timely dispatch',
                    'Accurate payment tracking and bank reconciliation',
                    'Systematic follow-up on overdue accounts',
                    'Complete customer account management',
                    'Regular cash flow analysis and reporting'
                ])
            ],
            [
                'icon' => 'credit-card',
                'title' => 'Accounts Payable (AP)',
                'description' => 'Efficient handling of supplier invoices, payments, and expense tracking to keep your accounts up to date.',
                'long_description' => 'We manage all your supplier relationships and payments, ensuring bills are paid on time while maintaining detailed expense records.',
                'points' => json_encode([
                    'Supplier invoice processing',
                    'Payment scheduling and execution',
                    'Expense categorization',
                    'Vendor relationship management',
                    'Monthly reporting'
                ]),
                'points_description' => json_encode([
                    'Efficient processing of all supplier invoices',
                    'Strategic payment scheduling and execution',
                    'Proper expense categorization for reporting',
                    'Professional vendor relationship management',
                    'Comprehensive monthly expense reporting'
                ])
            ]
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
