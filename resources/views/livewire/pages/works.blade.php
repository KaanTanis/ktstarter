<div>
    @php
        $banner = [
            'breadcrumb' => [
                [
                    'title' => trans('Ana Sayfa'),
                    'url' => route('home')
                ],
                [
                    'title' => trans('Projeler'),
                    'url' => route('works')
                ],
            ],
            'title' => trans('Projeler')
        ];
    @endphp

    <x-banner :$banner />

    <section class="my-24" id="works_card">
        <div class="container">
            <div class="grid gap-y-24 2xl:gap-y-72">
                @foreach ($works as $work)
                    <x-works.card :$work />
                @endforeach
            </div>

            @if ($hasMore)
            <div class="mt-8 md:mt-24 text-center">
                <a href="javascript:;" wire:click='loadMore' class="btn btn-primary">
                    @lang('Devamını Gör')
                </a>
            </div>
            @endif
            
        </div>
    </section>
</div>