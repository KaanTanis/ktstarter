<section class="mt-12">
    <hr>
    <div class="container mt-12">
    <div class="grid sm:justify-end justify-center">
        <form wire:submit='save'>
            <h2 class="footer-title">@lang('Haber Bülteni')</h2>
            <fieldset class="form-control w-full md::w-96">
            <label class="label">
                <span class="label-text">
                    @lang('Son gelişmelerden haberdar olmak ister misin?')
                </span>
            </label>
            <div class="join">
                <input
                    wire:model="email"
                    type="text"
                    placeholder="adiniz@site.com"
                    class="input input-bordered join-item" 
                />
                <button class="btn btn-primary join-item">@lang('Abone Ol')</button>
            </div>
            </fieldset>
            <span class="flex items-center text-xs gap-x-4 mt-4">
                <input type="checkbox" class="checkbox" id="gdpr" required />
                <label for="gdpr">
                    <a href="javascript:;"><b onclick="privacyModal.showModal()">@lang('Gizlilik Politikasını')</b></a> @lang('kabul ediyorum')
                </label>
            </span>
        </form>
    </div>
    </div>
</section>