<dialog id="privacyModal" class="modal">
    <div class="modal-box w-11/12 max-w-7xl prose">
        {!! App\Models\Setting::getValueByKey('privacy_policy') !!}
        <div class="modal-action">
            <form method="dialog">
                <button class="btn">@lang('Kapat')</button>
            </form>
        </div>
    </div>
</dialog>

<dialog id="cookieModal" class="modal">
    <div class="modal-box w-11/12 max-w-7xl prose">
        {!! App\Models\Setting::getValueByKey('cookie_consent') !!}
        <div class="modal-action">
            <form method="dialog">
                <button class="btn">@lang('Kapat')</button>
            </form>
        </div>
    </div>
</dialog>

<div id="cookieConsent"
    class="bg-primary text-primary-content fixed z-50 p-2 drop-shadow-2xl bottom-0 left-0 sm:bottom-8 sm:right-8 sm:left-auto hidden"
>
    <div class="flex items-center justify-between gap-6 text-sm">
        <div class="content-left pl-4">
            @lang('Bu web sitesi deneyiminizi geliştirmek için çerezler kullanır.')
            <span onclick="cookieModal.showModal()" class="sm:hidden underline text-xs">@lang('Detaylar')</span>
        </div>
        <div class="content-right text-end flex gap-y-2">
            <button class="btn btn-ghost px-4 py-2 cursor-pointer underline hidden sm:block" onclick="cookieModal.showModal()">@lang('Detaylar')</button>
            <button id="acceptCookie" class="btn px-4 py-2 cursor-pointer w-24 sm:w-auto">@lang('Kabul Et')</button>
        </div>
    </div>
</div>