<section class="bg-base-300 px-4 py-12 sm:p-24 grid items-center justify-center gap-y-4 text-center">
    <h1 class="text-xl sm:text-3xl font-bold">
        {{ data_get($banner, 'title') }}
    </h1>
    <div class="breadcrumbs text-sm justify-self-center">
        <ul class="[&>li>a]:font-normal font-light">
            @foreach (data_get($banner, 'breadcrumb') as $tree)
            @if (data_get($tree, 'url') === null)
                <li>
                    {{ data_get($tree, 'title') }}
                </li>

                @continue
            @endif
                <li>
                    <a href="{{ data_get($tree, 'url') }}" wire:navigate>
                        {{ data_get($tree, 'title') }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</section>