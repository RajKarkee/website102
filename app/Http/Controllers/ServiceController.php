<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        // Get services from database
        $dbServices = Service::with('color')->get();

        // If no services in database, use fallback data
        if ($dbServices->isEmpty()) {
            $services = [
                [
                    'icon' => 'users',
                    'title' => 'Payroll Management',
                    'description' => 'Accurate payroll processing, payslip preparation, leave management, and KiwiSaver compliance, ensuring your employees are paid correctly and on time.',
                    'color' => 'bg-blue-600',
                    'link' => 'services.payroll-management'
                ],
                [
                    'icon' => 'file-text',
                    'title' => 'Accounts Receivable (AR)',
                    'description' => 'We manage your invoicing, follow up on outstanding payments, and help maintain a healthy cash flow for your business.',
                    'color' => 'bg-green-600',
                    'link' => 'services.accounts-receivable'
                ],
                [
                    'icon' => 'credit-card',
                    'title' => 'Accounts Payable (AP)',
                    'description' => 'Efficient handling of supplier invoices, payments, and expense tracking to keep your accounts up to date.',
                    'color' => 'bg-purple-600',
                    'link' => 'services.accounts-payable'
                ],
                [
                    'icon' => 'dollar-sign',
                    'title' => 'Credit Control',
                    'description' => 'Proactive monitoring and management of your customer debts to reduce overdue accounts and improve cash collection.',
                    'color' => 'bg-red-600',
                    'link' => 'services.credit-control'
                ],
                [
                    'icon' => 'trending-up',
                    'title' => 'Payroll Data Entry',
                    'description' => 'Fast and accurate data entry of payroll information to ensure smooth payroll runs and easy reporting.',
                    'color' => 'bg-indigo-600',
                    'link' => 'services.payroll-data-entry'
                ],
                [
                    'icon' => 'building',
                    'title' => 'GST Filing & Compliance',
                    'description' => 'Preparation and filing of Goods and Services Tax (GST) returns with IRD, so you never miss a deadline.',
                    'color' => 'bg-orange-600',
                    'link' => 'services.gst-filing'
                ],
                [
                    'icon' => 'zap',
                    'title' => 'PAYE Services',
                    'description' => 'We calculate and manage your Pay As You Earn (PAYE) obligations, ensuring correct deductions and timely payments to IRD.',
                    'color' => 'bg-yellow-600',
                    'link' => 'services.paye-services'
                ],
                [
                    'icon' => 'book-open',
                    'title' => 'Income Tax Returns',
                    'description' => 'Preparation and filing of annual income tax returns for sole traders, partnerships, and companies, maximizing your tax efficiency and compliance.',
                    'color' => 'bg-teal-600',
                    'link' => 'services.income-tax-returns'
                ],
                [
                    'icon' => 'graduation-cap',
                    'title' => 'Xero Accounting System Training',
                    'description' => 'Hands-on training to help you and your team confidently use Xero for everyday bookkeeping, invoicing, payroll, GST returns, and reporting.',
                    'color' => 'bg-pink-600',
                    'link' => 'services.xero-training'
                ]
            ];
        } else {
            // Transform database services to match the frontend format
            $services = $dbServices->map(function ($service) {
                return [
                    'id' => $service->id,
                    'icon' => $service->icon ?? 'sparkles',
                    'title' => $service->title,
                    'description' => $service->description,
                    'color' => $service->color && $service->color->tailwind_class ? $service->color->tailwind_class : 'bg-blue-600',
                    'link' => 'services.detail', // Generic link, can be enhanced later
                    'long_description' => $service->long_description,
                    'points' => is_array($service->points) ? $service->points : [],
                    'points_description' => is_array($service->points_description) ? $service->points_description : []
                ];
            })->toArray();
        }

        return view('services.index', compact('services'));
    }

    public function payrollManagement()
    {
        return view('services.payroll-management');
    }

    public function accountsReceivable()
    {
        return view('services.accounts-receivable');
    }

    public function accountsPayable()
    {
        return view('services.accounts-payable');
    }

    public function creditControl()
    {
        return view('services.credit-control');
    }

    public function payrollDataEntry()
    {
        return view('services.payroll-data-entry');
    }

    public function gstFiling()
    {
        return view('services.gst-filing');
    }

    public function payeServices()
    {
        return view('services.paye-services');
    }

    public function incomeTaxReturns()
    {
        return view('services.income-tax-returns');
    }

    public function xeroTraining()
    {
        return view('services.xero-training');
    }
}
