
            <!-- Our Values -->
            <div class="mb-20">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold mb-4 text-primary">
                        Our Core Values
                    </h2>
                    <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                        These principles guide everything we do and shape how we serve our clients
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @php
                        $values = [
                            [
                                'icon' => 'shield',
                                'title' => 'Integrity',
                                'description' =>
                                    'We maintain the highest ethical standards in all our professional dealings and always act in our clients\' best interests.',
                            ],
                            [
                                'icon' => 'star',
                                'title' => 'Excellence',
                                'description' =>
                                    'We strive for excellence in every service we provide, continuously improving our processes and expertise.',
                            ],
                            [
                                'icon' => 'users',
                                'title' => 'Partnership',
                                'description' =>
                                    'We build long-term partnerships with our clients, becoming trusted advisors who understand their unique needs.',
                            ],
                        ];
                    @endphp

                    @foreach ($values as $value)
                        <div class="gradient-card p-8 text-center border-0 rounded-xl shadow-sm">
                            <div class="w-16 h-16 bg-primary rounded-xl flex items-center justify-center mx-auto mb-6">
                                <i data-lucide="{{ $value['icon'] }}" class="h-8 w-8 text-white"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-foreground mb-4">{{ $value['title'] }}</h3>
                            <p class="text-muted-foreground leading-relaxed">{{ $value['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
