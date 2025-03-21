@props(['page'])
<x-layouts.app>
    <x-filament-fabricator::page-blocks :blocks="$page->blocks" />
</x-layouts.app>