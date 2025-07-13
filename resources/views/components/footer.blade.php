<!-- Valued Partners Section -->
<section class="bg-slate-50 py-12 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-slate-900 mb-2">Valued Partners</h2>
            <p class="text-slate-600">Trusted by industry leaders and integrated with the best platforms</p>
        </div>
        
        <!-- Marquee Container -->
        <div class="relative">
            <div class="flex animate-marquee space-x-12 items-center">
                @php
                    $partners = [
                        ['name' => 'Xero', 'logo' => 'https://cdn.worldvectorlogo.com/logos/xero-2.svg'],
                        ['name' => 'MYOB', 'logo' => 'https://cdn.worldvectorlogo.com/logos/myob-1.svg'],
                        ['name' => 'QuickBooks', 'logo' => 'https://cdn.worldvectorlogo.com/logos/quickbooks-1.svg'],
                        ['name' => 'IRD', 'logo' => 'https://www.ird.govt.nz/-/media/project/ir/home/images/logos/ird-logo-colour.svg'],
                        ['name' => 'NZICA', 'logo' => 'https://www.charteredaccountantsanz.com/-/media/caa/images/logos/ca-anz-logo-stacked.svg'],
                        ['name' => 'CPA Australia', 'logo' => 'https://cdn.worldvectorlogo.com/logos/cpa-australia.svg'],
                        ['name' => 'ASB Bank', 'logo' => 'https://cdn.worldvectorlogo.com/logos/asb-bank.svg'],
                        ['name' => 'ANZ Bank', 'logo' => 'https://cdn.worldvectorlogo.com/logos/anz-2.svg'],
                        ['name' => 'Westpac', 'logo' => 'https://cdn.worldvectorlogo.com/logos/westpac-1.svg'],
                        ['name' => 'BNZ', 'logo' => 'https://cdn.worldvectorlogo.com/logos/bank-of-new-zealand-bnz.svg']
                    ];
                @endphp
                
                <!-- First set of partners -->
                @foreach($partners as $partner)
                    <div class="flex-shrink-0 flex items-center justify-center bg-white rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow min-w-[160px] h-20 group">
                        <img src="{{ $partner['logo'] }}" 
                             alt="{{ $partner['name'] }} logo"
                             class="max-h-10 max-w-[130px] object-contain filter grayscale group-hover:grayscale-0 transition-all duration-300"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                        <div class="text-center flex items-center justify-center w-full h-full" style="display: none;">
                            <div class="text-sm font-semibold text-slate-700">{{ $partner['name'] }}</div>
                        </div>
                    </div>
                @endforeach
                
                <!-- Duplicate set for seamless loop -->
                @foreach($partners as $partner)
                    <div class="flex-shrink-0 flex items-center justify-center bg-white rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow min-w-[160px] h-20 group">
                        <img src="{{ $partner['logo'] }}" 
                             alt="{{ $partner['name'] }} logo"
                             class="max-h-10 max-w-[130px] object-contain filter grayscale group-hover:grayscale-0 transition-all duration-300"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                        <div class="text-center flex items-center justify-center w-full h-full" style="display: none;">
                            <div class="text-sm font-semibold text-slate-700">{{ $partner['name'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<footer class="bg-card border-t border-border">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            <!-- Company Info -->
            <div class="lg:col-span-2 space-y-6">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center">
                        <i data-lucide="rocket" class="h-7 w-7 text-primary-foreground"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-primary">
                            B&B Tax
                        </h3>
                        <p class="text-xs text-muted-foreground font-mono">NEXT-GEN ACCOUNTING</p>
                    </div>
                </div>
                
                <p class="text-muted-foreground leading-relaxed max-w-md">
                    Comprehensive accounting services tailored to the needs of small businesses across New Zealand. 
                    We help you stay compliant, organized, and focused on growing your business.
                </p>
                
                <div class="space-y-3">
                    <div class="flex items-center space-x-3 group">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i data-lucide="map-pin" class="h-4 w-4 text-white"></i>
                        </div>
                        <span class="text-muted-foreground group-hover:text-foreground transition-colors">
                            Level 15, Innovation Tower, Auckland 1010
                        </span>
                    </div>
                    <div class="flex items-center space-x-3 group">
                        <div class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i data-lucide="phone" class="h-4 w-4 text-white"></i>
                        </div>
                        <span class="text-muted-foreground group-hover:text-foreground transition-colors">
                            +64 9 123 4567
                        </span>
                    </div>
                    <div class="flex items-center space-x-3 group">
                        <div class="w-8 h-8 bg-purple-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i data-lucide="mail" class="h-4 w-4 text-white"></i>
                        </div>
                        <span class="text-muted-foreground group-hover:text-foreground transition-colors">
                            hello@bnbtax.nz
                        </span>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-semibold text-foreground mb-6">Navigation</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}" class="text-muted-foreground hover:text-primary transition-colors hover:translate-x-2 transform duration-200 inline-block">Home</a></li>
                    <li><a href="{{ route('services.index') }}" class="text-muted-foreground hover:text-primary transition-colors hover:translate-x-2 transform duration-200 inline-block">Services</a></li>
                    <li><a href="{{ route('about') }}" class="text-muted-foreground hover:text-primary transition-colors hover:translate-x-2 transform duration-200 inline-block">About</a></li>
                    <li><a href="{{ route('team') }}" class="text-muted-foreground hover:text-primary transition-colors hover:translate-x-2 transform duration-200 inline-block">Team</a></li>
                    <li><a href="{{ route('testimonials') }}" class="text-muted-foreground hover:text-primary transition-colors hover:translate-x-2 transform duration-200 inline-block">Testimonials</a></li>
                    <li><a href="{{ route('resources') }}" class="text-muted-foreground hover:text-primary transition-colors hover:translate-x-2 transform duration-200 inline-block">Resources</a></li>
                    <li><a href="{{ route('contact') }}" class="text-muted-foreground hover:text-primary transition-colors hover:translate-x-2 transform duration-200 inline-block">Contact</a></li>
                </ul>
            </div>

            <!-- Services -->
            <div>
                <h4 class="text-lg font-semibold text-foreground mb-6">Solutions</h4>
                <ul class="space-y-3 text-sm">
                    <li class="text-muted-foreground hover:text-accent transition-colors cursor-pointer">AI Payroll Management</li>
                    <li class="text-muted-foreground hover:text-accent transition-colors cursor-pointer">Smart GST Filing</li>
                    <li class="text-muted-foreground hover:text-accent transition-colors cursor-pointer">Tax Optimization</li>
                    <li class="text-muted-foreground hover:text-accent transition-colors cursor-pointer">Digital Transformation</li>
                    <li class="text-muted-foreground hover:text-accent transition-colors cursor-pointer">Xero Mastery</li>
                    <li class="text-muted-foreground hover:text-accent transition-colors cursor-pointer">Compliance Automation</li>
                    <li class="text-muted-foreground hover:text-accent transition-colors cursor-pointer">Financial Intelligence</li>
                </ul>
            </div>
        </div>

        <div class="border-t border-border mt-12 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <p class="text-muted-foreground text-sm">
                    © 2024 B&B Tax and Accounting Service Limited. Pioneering the future of finance.
                </p>
                
                <div class="flex items-center space-x-6">
                    <div class="flex space-x-4">
                        <div class="w-10 h-10 bg-gray-700 rounded-lg flex items-center justify-center cursor-pointer hover:scale-110 transition-transform">
                            <i data-lucide="github" class="h-5 w-5 text-white"></i>
                        </div>
                        <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center cursor-pointer hover:scale-110 transition-transform">
                            <i data-lucide="twitter" class="h-5 w-5 text-white"></i>
                        </div>
                        <div class="w-10 h-10 bg-blue-700 rounded-lg flex items-center justify-center cursor-pointer hover:scale-110 transition-transform">
                            <i data-lucide="linkedin" class="h-5 w-5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
