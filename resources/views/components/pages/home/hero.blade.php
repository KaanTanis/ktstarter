<section class="min-h-[calc(100vh-4.5rem)] flex items-center justify-center" id="hero_section">
    <div>
        <div class="container grid gap-y-4" id="home_hero">
            <h1 class="text-7xl relative -top-20 text-center sm:hidden font-bold">
                <span class="mr-24" id="hero_title_1">Kaan</span> <br>
                <span class="ml-24" id="hero_title_2">Tanış</span>
            </h1>
            <div class="grid grid-cols-2">
                <div class="self-center justify-self-start">
                    <h2 class="text-3xl sm:text-4xl md:text-6xl lg:text-7xl xl:text-8xl font-bold" id="designer">
                        {{ data_get($hero, 'title') }}
                    </h2>
                </div>
                <div>
                    <img src="{{ Storage::url(data_get($hero, 'image')) }}" id="designer_image"
                        width="600" height="300"
                        alt="Kaan Tanış - {{ data_get($hero, 'title') }}"
                        class="aspect-[5/2] w-full rounded-full shadow object-cover"
                    >
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div>
                    <img src="{{ Storage::url(data_get($hero, 'image_2')) }}" id="developer_image"
                        width="600" height="300"
                        alt="Kaan Tanış - {{ data_get($hero, 'title_2') }}"
                        class="aspect-[5/2] w-full rounded-full shadow object-cover"
                    >
                </div>
                <div class="self-center justify-self-end">
                    <h2 class="text-3xl sm:text-4xl md:text-6xl lg:text-7xl xl:text-8xl font-bold" id="developer">
                        {{ data_get($hero, 'title_2') }}
                    </h2>
                </div>
            </div>
        </div>

        <div class="container grid justify-end mt-24">
            <ul class="grid gap-y-2">
                <li>
                    <a href="https://github.com/{{ data_get($hero, 'github_user_name') }}" target="_blank" class="flex gap-x-2 text-xs items-center">
                        <svg id='GitHub_24' class="size-5" viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'><rect width='24' height='24' stroke='none' fill='currentColor' opacity='0'/>
                            <g transform="matrix(1 0 0 1 12 12)" >
                            <path style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: currentColor; fill-rule: nonzero; opacity: 1;" transform=" translate(-12.02, -11.73)" d="M 10.9 2.1 C 6.300000000000001 2.6 2.5999999999999996 6.300000000000001 2.0999999999999996 10.799999999999999 C 1.5999999999999996 15.5 4.3 19.7 8.399999999999999 21.299999999999997 C 8.7 21.4 9 21.2 9 20.8 L 9 19.2 C 9 19.2 8.6 19.3 8.1 19.3 C 6.699999999999999 19.3 6.1 18.1 6 17.400000000000002 C 5.9 17.000000000000004 5.7 16.700000000000003 5.4 16.400000000000002 C 5.1 16.3 5 16.3 5 16.2 C 5 16 5.3 16 5.4 16 C 6 16 6.5 16.7 6.7 17 C 7.2 17.8 7.800000000000001 18 8.1 18 C 8.5 18 8.799999999999999 17.9 9 17.8 C 9.1 17.1 9.4 16.400000000000002 10 16 C 7.7 15.5 6 14.2 6 12 C 6 10.9 6.5 9.8 7.2 9 C 7.1 8.8 7 8.3 7 7.6 C 7 7.199999999999999 7 6.699999999999999 7.2 6.3 C 7.2 6.1 7.4 6 7.5 6 C 7.5 6 7.6 6 7.6 6 C 8.1 6.1 9.1 6.4 10 7.3 C 10.6 7.1 11.3 7 12 7 C 12.7 7 13.4 7.1 14 7.3 C 14.9 6.3999999999999995 16 6.1 16.5 6 C 16.5 6 16.6 6 16.6 6 C 16.8 6 16.900000000000002 6.1 17 6.3 C 17 6.7 17 7.2 17 7.6 C 17 8.4 16.9 8.799999999999999 16.8 9 C 17.5 9.8 18 10.8 18 12 C 18 14.2 16.3 15.5 14 16 C 14.6 16.5 15 17.4 15 18.3 L 15 20.900000000000002 C 15 21.200000000000003 15.3 21.500000000000004 15.7 21.400000000000002 C 19.4 19.900000000000002 22 16.300000000000004 22 12.100000000000001 C 22 6.1 16.9 1.4 10.9 2.1 z" stroke-linecap="round" />
                            </g>
                        </svg>
                        {{ data_get($hero, 'github_user_name') }}
                    </a>
                </li>
                <li>
                    <a href="https://wa.me/{{ str(data_get($hero, 'whatsapp_no'))->replace(['(', ')', ' '], null) }}" target="_blank" class="flex gap-x-2 text-xs items-center">
                        <svg id='WhatsApp_24' class="size-5" viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'><rect width='24' height='24' stroke='none' fill='currentColor' opacity='0'/>
                            <g transform="matrix(1 0 0 1 12 12)" >
                            <path style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: currentColor; fill-rule: nonzero; opacity: 1;" transform=" translate(-12, -12)" d="M 12.011719 2 C 6.5057187 2 2.0234844 6.478375 2.0214844 11.984375 C 2.0204844 13.744375 2.4814687 15.462563 3.3554688 16.976562 L 2 22 L 7.2324219 20.763672 C 8.6914219 21.559672 10.333859 21.977516 12.005859 21.978516 L 12.009766 21.978516 C 17.514766 21.978516 21.995047 17.499141 21.998047 11.994141 C 22.000047 9.3251406 20.962172 6.8157344 19.076172 4.9277344 C 17.190172 3.0407344 14.683719 2.001 12.011719 2 z M 12.009766 4 C 14.145766 4.001 16.153109 4.8337969 17.662109 6.3417969 C 19.171109 7.8517969 20.000047 9.8581875 19.998047 11.992188 C 19.996047 16.396187 16.413812 19.978516 12.007812 19.978516 C 10.674812 19.977516 9.3544062 19.642812 8.1914062 19.007812 L 7.5175781 18.640625 L 6.7734375 18.816406 L 4.8046875 19.28125 L 5.2851562 17.496094 L 5.5019531 16.695312 L 5.0878906 15.976562 C 4.3898906 14.768562 4.0204844 13.387375 4.0214844 11.984375 C 4.0234844 7.582375 7.6067656 4 12.009766 4 z M 8.4765625 7.375 C 8.3095625 7.375 8.0395469 7.4375 7.8105469 7.6875 C 7.5815469 7.9365 6.9355469 8.5395781 6.9355469 9.7675781 C 6.9355469 10.995578 7.8300781 12.182609 7.9550781 12.349609 C 8.0790781 12.515609 9.68175 15.115234 12.21875 16.115234 C 14.32675 16.946234 14.754891 16.782234 15.212891 16.740234 C 15.670891 16.699234 16.690438 16.137687 16.898438 15.554688 C 17.106437 14.971687 17.106922 14.470187 17.044922 14.367188 C 16.982922 14.263188 16.816406 14.201172 16.566406 14.076172 C 16.317406 13.951172 15.090328 13.348625 14.861328 13.265625 C 14.632328 13.182625 14.464828 13.140625 14.298828 13.390625 C 14.132828 13.640625 13.655766 14.201187 13.509766 14.367188 C 13.363766 14.534188 13.21875 14.556641 12.96875 14.431641 C 12.71875 14.305641 11.914938 14.041406 10.960938 13.191406 C 10.218937 12.530406 9.7182656 11.714844 9.5722656 11.464844 C 9.4272656 11.215844 9.5585938 11.079078 9.6835938 10.955078 C 9.7955938 10.843078 9.9316406 10.663578 10.056641 10.517578 C 10.180641 10.371578 10.223641 10.267562 10.306641 10.101562 C 10.389641 9.9355625 10.347156 9.7890625 10.285156 9.6640625 C 10.223156 9.5390625 9.737625 8.3065 9.515625 7.8125 C 9.328625 7.3975 9.131125 7.3878594 8.953125 7.3808594 C 8.808125 7.3748594 8.6425625 7.375 8.4765625 7.375 z" stroke-linecap="round" />
                            </g>
                        </svg>
                        {{ data_get($hero, 'whatsapp_no') }}
                    </a>
                </li>
                <li>
                    <a href="mailto:{{ data_get($hero, 'email') }}" class="flex gap-x-2 text-xs items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                        {{ data_get($hero, 'email') }}
                    </a>
                </li>
            </ul>
        </div>

        <div class="container grid absolute bottom-5 justify-center">
            <a href="#works_card">
                <svg class="animate-pulse size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
                <span class="sr-only">@lang('İşler')</span>
            </a>
        </div>
    </div>
</section>