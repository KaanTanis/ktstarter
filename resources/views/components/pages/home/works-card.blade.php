<section class="pt-24" id="works_card">
    <div class="container">
        <div class="grid gap-y-24 2xl:gap-y-72">
            @foreach ($works as $work)
                <x-works.card :$work />
            @endforeach
        </div>

        <div class="mt-8 md:mt-24 text-center">
            <a href="@route('works')" wire:navigate class="btn btn-primary">
                @lang('Bütün Çalışmalar')
            </a>
        </div>
    </div>
</section>