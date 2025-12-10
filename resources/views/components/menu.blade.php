<li>
    <a href="#" @class([
        'hover:text-base-content',
        'text-base-content !font-bold' => true
    ])>@lang('Ana Sayfa')</a>
</li>
{{-- <li>
    <a href="{{ getLocalizedUrl(url: App\Models\Page::where('slug->en', 'about-us')->first()->url) }}" @class([
        'hover:text-base-content',
        'text-base-content !font-bold' => false
    ])>@lang('Hakkımızda')</a>
</li> --}}
<li>
    <details>
    <summary @class([
        'hover:text-base-content',
        'text-base-content !font-bold' => false
    ])>Parent item</summary>
    <ul>
        <li><a>Submenu 1</a></li>
        <li><a>Submenu 2</a></li>
        <li>
        <details>
            <summary>Parent</summary>
            <ul>
            <li><a>item 1</a></li>
            <li><a>item 2</a></li>
            </ul>
        </details>
        </li>
    </ul>
    </details>
</li>
<li>
    <a href="#" @class([
        'hover:text-base-content',
        'text-base-content !font-bold' => false
    ])>@lang('İletişim')</a>
</li>

<x-language-switcher />