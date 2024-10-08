<section id="step_section">
    <div class="container mt-32 sm:mt-48 px-8">
        <div class="text-center mb-16 sm:mb-8">
            <h1 class="sm:text-4xl text-3xl font-bold">
                @lang('Nasıl Çalışıyorum?')
            </h1>
        </div>
        <div class="space-y-20 stepCards mb-72">
            @foreach ($steps as $step)
            <div class="bg-base-300 text-base-content rounded-3xl shadow-lg p-8 flex flex-col lg:flex-row items-center space-y-4 lg:space-y-0 lg:space-x-4 gap-y-4 relative stepCard">
                <div @class([
                    'flex-1',
                    'order-2 ml-4' => $loop->even,
                ])>
                    <span @class([
                        'text-xl font-bold absolute bg-base-300 text-base-content px-6 py-4 shadow-lg -top-8 sm:-top-4',
                        '-left-4 rounded-tl-3xl' => $loop->odd,
                        '-right-4 rounded-tr-3xl' => $loop->even,
                    ])>
                        {{ $loop->iteration }}
                    </span>
                    <h2 class="text-2xl font-semibold">
                        {{ data_get($step, 'title') }}
                    </h2>
                    <p class="mt-4">
                        {!! data_get($step, 'content') !!}
                    </p>
                </div>
                <div @class([
                    'flex-none w-full lg:w-1/3 !m-0',
                    'order-1' => $loop->even,
                ])>
                    <img src="{{ Storage::url(data_get($step, 'image')) }}" 
                        width="400" height="400"
                        alt="Kaan Tanış - {{ data_get($step, 'title') }}" class="rounded-2xl w-full"
                    >
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>