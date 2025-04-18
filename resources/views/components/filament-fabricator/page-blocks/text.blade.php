@props([
    'text' => null,
])

@aware(['page'])

<section class="container mx-auto py-12">
    <article class="prose !max-w-none">
        {!! $text !!}
    </article>
</section>
