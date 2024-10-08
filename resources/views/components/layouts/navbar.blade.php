<div class="navbar bg-base-100 container mt-2 relative z-10 w-full flex justify-between items-center">
    <div class="navbar-start">
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
                <span class="sr-only">@lang('Menü')</span>
            </div>
            <ul
                tabindex="0"
                class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow"
            >
                <li>
                    <a href="@route('works')" wire:navigate 
                        @class([
                            'font-semibold' => request()->routeIs('works') || request()->routeIs('work')
                        ])
                    >
                        @lang('İşler')
                    </a>
                </li>
                <li>
                    <a href="@route('about')" wire:navigate
                        @class([
                            'font-semibold' => request()->routeIs('about')
                        ])
                    >
                        @lang('Hakkımda')
                    </a>
                </li>
                <li>
                    <a href="@route('blogs')" wire:navigate
                        @class([
                            'font-semibold' => request()->routeIs('blogs') || request()->routeIs('blog')
                        ])
                    >
                        @lang('Blog')
                    </a>
                </li>
                <li>
                    <a href="javascript:;" onclick="offerForm.showModal()">
                        @lang('Teklif Al')
                    </a>
                </li>
            </ul>
        </div>
        <a href="@route('home')" class="btn btn-link p-2 sm:p-0" wire:navigate>
            <x-logo />
        </a>
    </div>
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1">
            <li>
                <a href="@route('works')" wire:navigate 
                    @class([
                        'font-semibold' => request()->routeIs('works') || request()->routeIs('work')
                    ])
                >
                    @lang('İşler')
                </a>
            </li>
            <li>
                <a href="@route('about')" wire:navigate
                    @class([
                        'font-semibold' => request()->routeIs('about')
                    ])
                >
                    @lang('Hakkımda')
                </a>
            </li>
            <li>
                <a href="@route('blogs')" wire:navigate
                    @class([
                        'font-semibold' => request()->routeIs('blogs') || request()->routeIs('blog')
                    ])
                >
                    @lang('Blog')
                </a>
            </li>
            <li>
                <a href="javascript:;" onclick="offerForm.showModal()">
                    @lang('Teklif Al')
                </a>
            </li>
        </ul>
    </div>
    <div class="navbar-end">
        <span class="mr-4 lg:mr-0 grid items-center">
            <x-layouts.navbar.theme-controller />
        </span>
    </div>
</div>