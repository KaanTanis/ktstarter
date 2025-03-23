@props([
    'text' => null,
])

@aware(['page'])

<section class="container mx-auto">
    <p class="whitespace-pre-line">
        {{ $text }}
    </p>
</section>
