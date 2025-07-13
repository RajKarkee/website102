<nav class="fixed w-full z-50 backdrop-blur-xl bg-background/80 border-b border-border" x-data="{ isOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <div class="flex-shrink-0 flex items-center space-x-3">
                    <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center animate-glow">
                        <i data-lucide="zap" class="h-6 w-6 text-primary-foreground"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-primary">
                            B&B Tax
                        </h1>
                        <p class="text-xs text-muted-foreground font-mono">ACCOUNTING.NZ</p>
                    </div>
                </div>
            </div>
            
            <!-- Desktop menu -->
            <div class="hidden md:flex items-center space-x-1">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    Home
                </a>
                <a href="{{ route('services.index') }}" class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}">
                    Services
                </a>
                <a href="{{ route('industries') }}" class="nav-link {{ request()->routeIs('industries') ? 'active' : '' }}">
                    Industries
                </a>
                <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">
                    About
                </a>
                <a href="{{ route('team') }}" class="nav-link {{ request()->routeIs('team') ? 'active' : '' }}">
                    Team
                </a>
                <a href="{{ route('testimonials') }}" class="nav-link {{ request()->routeIs('testimonials') ? 'active' : '' }}">
                    Testimonials
                </a>
                <a href="{{ route('resources') }}" class="nav-link {{ request()->routeIs('resources') ? 'active' : '' }}">
                    Resources
                </a>
                <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">
                    Contact
                </a>
                <a href="{{ route('contact') }}" class="ml-4 bg-primary hover:bg-primary/90 text-primary-foreground font-semibold px-6 py-2 rounded-full transition-colors">
                    Request Proposal
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button @click="isOpen = !isOpen" class="text-foreground hover:bg-secondary p-2 rounded-lg">
                    <i data-lucide="menu" x-show="!isOpen" class="h-6 w-6"></i>
                    <i data-lucide="x" x-show="isOpen" class="h-6 w-6"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="isOpen" x-transition class="md:hidden border-t border-border">
        <div class="px-2 pt-2 pb-3 space-y-1 bg-card/95 backdrop-blur-xl">
            <a href="{{ route('home') }}" class="mobile-nav-link" @click="isOpen = false">Home</a>
            <a href="{{ route('services.index') }}" class="mobile-nav-link" @click="isOpen = false">Services</a>
            <a href="{{ route('industries') }}" class="mobile-nav-link" @click="isOpen = false">Industries</a>
            <a href="{{ route('about') }}" class="mobile-nav-link" @click="isOpen = false">About</a>
            <a href="{{ route('team') }}" class="mobile-nav-link" @click="isOpen = false">Team</a>
            <a href="{{ route('testimonials') }}" class="mobile-nav-link" @click="isOpen = false">Testimonials</a>
            <a href="{{ route('resources') }}" class="mobile-nav-link" @click="isOpen = false">Resources</a>
            <a href="{{ route('contact') }}" class="mobile-nav-link" @click="isOpen = false">Contact</a>
            <a href="{{ route('contact') }}" class="w-full mt-4 bg-primary hover:bg-primary/90 text-primary-foreground rounded-full px-6 py-3 block text-center font-semibold" @click="isOpen = false">
                Request Proposal
            </a>
        </div>
    </div>
</nav>
