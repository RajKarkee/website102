 

            <!-- Company Overview -->
            @foreach ($about as $aboutData)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-20">
                    <div>
                        <h2 class="text-3xl font-bold mb-6 text-primary">
                            {{ $aboutData->title }}
                        </h2>
                        @php
                            $description = strip_tags($aboutData->description ?? '');
                            if (!is_string($description)) {
                                $description = (string) $description;
                            }
                            $words = str_word_count($description, 1);
                            $half = ceil(count($words) / 2);
                            $firstHalf = implode(' ', array_slice($words, 0, $half));
                            $secondHalf = implode(' ', array_slice($words, $half));
                        @endphp

                        <p class="text-lg text-muted-foreground mb-6 leading-relaxed">
                            {{ $firstHalf }}
                        </p>
                        <p class="text-lg text-muted-foreground mb-8 leading-relaxed">
                            {{ $secondHalf }}
                        </p>

                        <div class="grid grid-cols-2 gap-6">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-primary mb-2">{{ $aboutData->Experience }}</div>
                                <div class="text-muted-foreground">Years Experience</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-primary mb-2">{{ $aboutData->client }}</div>
                                <div class="text-muted-foreground">Happy Clients</div>
                            </div>
                        </div>
                    </div>
                    <div class="relative">
                        <img src="{{ asset('storage/' . $aboutData->image) }}" alt="B&B Tax team"
                            class="rounded-2xl shadow-xl w-full h-auto">
                    </div>
                </div>
            @endforeach

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

   