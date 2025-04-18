@props([
    'text' => null,
])

@aware(['page'])

<section class="container mx-auto">
    <article class="prose !max-w-none">
        {!! $text !!}
    </article>
</section>
