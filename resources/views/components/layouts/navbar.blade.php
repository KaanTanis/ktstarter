<section>
    <nav @class([
        'h-[120px] bg-base-200 z-10 relative z-[100]',
    ])>
        <div class="container mx-auto flex items-center justify-between py-8">
            <div>
                <a href="/">
                    <img src="/logo.svg" alt="{{ config('app.name') }} - logo" class="object-cover w-16 h-auto">
                </a>
            </div>
            <div class="hidden xl:block">
                <ul class="flex items-center gap-x-12 [&>li>a]:font-semibold text-base-content/80 [&>li>a]:transition-all navMenu">
                    <x-menu />
                </ul>
            </div>
            <div class="z-[100] xl:hidden">
                <div class="drawer">
                    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
                    <div class="drawer-content">
                        <!-- Page content here -->
                        <label for="my-drawer" class="btn btn-circle drawer-button text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M12 17.25h8.25" />
                            </svg>
                        </label>
                    </div>
                    <div class="drawer-side">
                        <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
                        <div class="menu bg-primary text-primary-content min-h-full w-80 p-4">
                            <div class="py-6 self-center">
                                <img src="/logo.svg" alt="{{ config('app.name') }} - logo" class="h-[8rem] object-contain">
                            </div>

                            <div class="divider divider-primary"></div>

                            <ul class="text-lg mt-4 navMenu">
                                <x-menu />
                            </ul>

                            <div class="divider divider-primary"></div>

                            <ul class="flex items-center justify-center">
                                <li>
                                    <a target="_blank" href="https://www.instagram.com/levonartyapi/">
                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 30 30" class="fill-current">
                                            <path d="M 9.9980469 3 C 6.1390469 3 3 6.1419531 3 10.001953 L 3 20.001953 C 3 23.860953 6.1419531 27 10.001953 27 L 20.001953 27 C 23.860953 27 27 23.858047 27 19.998047 L 27 9.9980469 C 27 6.1390469 23.858047 3 19.998047 3 L 9.9980469 3 z M 22 7 C 22.552 7 23 7.448 23 8 C 23 8.552 22.552 9 22 9 C 21.448 9 21 8.552 21 8 C 21 7.448 21.448 7 22 7 z M 15 9 C 18.309 9 21 11.691 21 15 C 21 18.309 18.309 21 15 21 C 11.691 21 9 18.309 9 15 C 9 11.691 11.691 9 15 9 z M 15 11 A 4 4 0 0 0 11 15 A 4 4 0 0 0 15 19 A 4 4 0 0 0 19 15 A 4 4 0 0 0 15 11 z"></path>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a target="_blank" href="https://www.youtube.com/@levonartyap8932">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            class="fill-current">
                                            <path
                                            d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"></path>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a target="_blank" href="https://www.facebook.com/p/Levonart-Yap%C4%B1-100068953908345/?locale=tr_TR&_rdr">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            class="fill-current">
                                            <path
                                            d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path>
                                        </svg>
                                    </a>
                                </li>
                            </ul>

                            <div class="divider"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </nav>
</section>