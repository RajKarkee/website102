         <div class="mb-20">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold mb-4 text-primary">
                        {{ $about->point_title }}
                    </h2>
                    <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                        {{ $about->point_description }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @for ($i = 1; $i <= 4; $i++)
                        <div class="flex items-start space-x-4 p-6">
                            <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center flex-shrink-0">
                                @if (!empty($points[$i]['icon']))
                               
                                    <img src="{{ asset('storage/' . $points[$i]['icon']) }}" alt="Icon {{ $i }}"
                                       >
                                @else
                                    <span class="text-muted">No icon</span>
                                @endif
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-foreground mb-2">{{ $points[$i]['title'] }}</h3>
                                <p class="text-muted-foreground">{{ $points[$i]['description'] }}</p>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>