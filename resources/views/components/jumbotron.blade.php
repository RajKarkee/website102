<section class="pt-16 sm:pt-20 min-h-[60vh] bg-cover bg-center bg-no-repeat flex items-center relative" 
         style="background-image: url('{{ $backgroundImage }}');">
    <div class="absolute inset-0 bg-black/60"></div>
    
    <div class="relative z-20 w-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-20">
            <div class="max-w-3xl">
                <div class="flex items-center space-x-2 mb-4 sm:mb-6">
                    {!! $icon !!}
                    <span class="text-yellow-400 font-mono text-xs sm:text-sm tracking-wider uppercase">{{ $badge }}</span>
                </div>
                
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6 sm:mb-8 text-white">
                    {{ $title }}
                    @if($subtitle)
                        <br>
                        <span class="text-white/90 text-lg sm:text-xl md:text-2xl lg:text-3xl font-normal">{{ $subtitle }}</span>
                    @endif
                </h1>
                
                <p class="text-lg sm:text-xl md:text-2xl text-white/90 leading-relaxed mb-8 sm:mb-12 max-w-2xl">
                    {{ $description }}
                </p>
            </div>
        </div>
    </div>
</section>
