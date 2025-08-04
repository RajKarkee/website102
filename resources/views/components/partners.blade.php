<section class="bg-slate-50 py-12 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-slate-900 mb-2">{{ $partnerHeading->title ?? 'Valued Partners' }}</h2>
            <p class="text-slate-600">{{ $partnerHeading->description ?? 'Trusted by industry leaders and integrated with the best platforms' }}</p>
        </div>
        
        <!-- Marquee Container -->
        <div class="relative">
            <div class="flex animate-marquee space-x-12 items-center">
                {{-- @php
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
                @endphp --}}
                
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