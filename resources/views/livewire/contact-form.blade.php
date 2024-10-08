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

        <div class="col-span-2 sm:flex sm:justify-between grid grid-cols-2 gap-y-8 sm:gap-y-0 my-4">
            <label for="uiux" for="" class="flex items-center gap-x-2">
                @lang('UI/UX Design')
                <input wire:model='services' value="ui-ux-design" id="uiux" type="checkbox" @class([
                    'checkbox',
                    'input-error' => $errors->has('services')
                ]) />
            </label>
            <label for="backend" class="flex items-center gap-x-2">
                @lang('Backend Development')
                <input wire:model='services' value="backend-development" id="backend" type="checkbox" @class([
                    'checkbox',
                    'input-error' => $errors->has('services')
                ]) />
            </label>
            <label for="bug" class="flex items-center gap-x-2">
                @lang('Bug Fixing')
                <input wire:model='services' value="bug-fixing" id="bug" type="checkbox" @class([
                    'checkbox',
                    'input-error' => $errors->has('services')
                ]) />
            </label>
            <label for="other" class="flex items-center gap-x-2">
                @lang('Diğer/Bilmiyorum')
                <input wire:model='services' value="other" id="other" type="checkbox" @class([
                    'checkbox',
                    'checkbox-error' => $errors->has('services')
                ]) />
            </label>
        </div>

        <div class="col-span-2 my-4">
            <h3 class="mb-2">@lang('Bütçe')</h3>
            <label>
                <span class="sr-only">@lang('Bütçe Seçin')</span>
                <input wire:model='budget' type="range" min="0" max="75" step="25" @class([
                    'range',
                    'range-error' => $errors->has('budget')
                ]) />
            </label>
            <div class="flex w-full justify-between px-2 text-xs">
                <span>250$-600$</span>
                <span>600$-1,200$</span>
                <span>1,200$-2,500$</span>
                <span>2,500$+</span>
            </div>
        </div>

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