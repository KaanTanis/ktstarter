<form action="" class="{{ $classes }}" wire:submit='save'>
    <div class="grid sm:grid-cols-2 gap-6 sm:gap-12">
        <input type="text" wire:model='name' placeholder="@lang('Adınız')" @class([
            'input input-bordered w-full col-span-2 sm:col-span-1',
            'input-error' => $errors->has('name')
        ]) />
        <input type="text" wire:model='phone' placeholder="@lang('Telefon Numaranız')" @class([
            'input input-bordered w-full col-span-2 sm:col-span-1',
            'input-error' => $errors->has('phone')
        ]) />
        <input type="text" wire:model='email' placeholder="@lang('E-posta Adresiniz')" @class([
            'input input-bordered w-full block col-span-2',
            'input-error' => $errors->has('email')
        ]) />

        <textarea wire:model='message' rows="6" placeholder="@lang('Proje Detayları')" @class([
            'textarea textarea-bordered col-span-2',
            'textarea-error' => $errors->has('message')
        ])></textarea>

        <div class="sm:flex grid gap-y-4     sm:justify-between col-span-2 items-center">
            <span class="flex items-center text-xs gap-x-4 mt-4">
                <input type="checkbox" class="checkbox" id="gdpr" required />
                <label for="gdpr">
                    <a href="javascript:;"><b onclick="privacyModal.showModal()">@lang('Gizlilik Politikasını')</b></a> @lang('kabul ediyorum')
                </label>
            </span>
            <button type="submit" class="btn btn-primary w-full sm:w-44">
                @lang('Gönder')
            </button>
        </div>
    </div>
</form>