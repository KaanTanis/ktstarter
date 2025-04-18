<li>
    <a href="#" @class([
        'hover:text-base-content',
        'text-base-content !font-bold' => true
    ])>@lang('Ana Sayfa')</a>
</li>
<li>
    <a href="#" @class([
        'hover:text-base-content',
        'text-base-content !font-bold' => false
    ])>@lang('Hakkımızda')</a>
</li>
<li>
    <div class="dropdown dropdown-end dropdown-hover">
        <div tabindex="0" role="button" @class([
            'hover:text-base-content font-semibold',
            'text-base-content !font-bold' => false,
        ])>Dropdown</div>
        <ul tabindex="0" class="dropdown-content menu bg-base-100 text-base-content rounded-box z-[1] w-52 p-2 shadow">
            <li>
                <a href="/seyirtepe-tarsus">Test</a>
            </li>
            <li>
                <a href="/tiba-vadi">Test 2</a>
            </li>
        </ul>
    </div>
</li>
<li>
    <a href="#" @class([
        'hover:text-base-content',
        'text-base-content !font-bold' => false
    ])>@lang('İletişim')</a>
</li>