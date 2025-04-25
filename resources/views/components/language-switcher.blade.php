<li>
    <details>
    <summary @class([
        'hover:text-base-content',
        'text-base-content !font-bold' => false
    ])>
        <object
            data="{{ asset('flags/' . LaravelLocalization::getCurrentLocaleRegional() . '.svg') }}"
            type="image/svg+xml"
            class="w-6 h-6">
        </object>
    </summary>
    <ul>
        @foreach (LaravelLocalization::getLocalesOrder() as $key => $locale)
        <li>
            <a class="w-full h-full" 
                rel="alternate" hreflang="{{ $key }}"
                href="{{ LaravelLocalization::getLocalizedURL($key, null, [], true) }}"
            >
                <object
                    data="{{ asset('flags/' . $locale['regional'] . '.svg') }}"
                    type="image/svg+xml"
                    class="w-6 h-6">
                </object>
                {{ $locale['native'] }}
            </a>
        </li>
        @endforeach
    </ul>
    </details>
</li>