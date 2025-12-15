@props([
    'src',
    'alt' => null,
    'class' => null
])


<img
    src="{{ $src->getUrl('responsive') }}"
    srcset="{{ $src->getSrcset('responsive') }}"
    alt=""
>
