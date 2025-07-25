@props([
    'icon' => 'target',
    'title' => 'Get Industry-Specific Solutions',
    'description' =>
        "Don't see your industry listed? We work with businesses across all sectors. Contact us to discuss your specific accounting needs and challenges.",
    'button1_text' => 'Discuss Your Needs',
    'button1_url' => route('contact'),
    'button2_text' => 'View Our Services',
    'button2_url' => route('services.index'),
])
<div class="text-center bg-primary/10 rounded-3xl p-12 border border-primary/20">
    <i data-lucide="{{ $icon }}" class="h-16 w-16 text-primary mx-auto mb-6"></i>
    <h2 class="text-3xl font-bold mb-6 text-primary">
        {{ $title }}
    </h2>
    <p class="text-lg text-muted-foreground mb-8 max-w-2xl mx-auto">
        {{ $description }}
    </p>
    <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="{{ route('contact') }}"
            class="bg-primary hover:bg-primary/90 text-white px-8 py-4 rounded-full text-lg font-semibold inline-flex items-center justify-center transition-colors">
            {{ $button1_text }}
            <i data-lucide="arrow-right" class="ml-2 h-5 w-5"></i>
        </a>
        <a href="{{ route('services.index') }}"
            class="border border-primary text-primary hover:bg-primary/10 px-8 py-4 rounded-full text-lg font-semibold inline-flex items-center justify-center transition-colors">
            {{ $button2_text }}
        </a>
    </div>
</div>
