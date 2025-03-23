@props(['page'])

<x-layouts.app :$page>
    <x-filament-fabricator::page-blocks :blocks="$page->blocks" />
</x-layouts.app>