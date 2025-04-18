<?php

namespace App\Livewire;

use App\Models\Form;
use Livewire\Component;
use App\Mail\ContactMail;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Mail;
use Filament\Notifications\Notification;
use Illuminate\Validation\ValidationException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;

class ContactForm extends Component
{
    use WithRateLimiting;

    #[Validate('required', as: 'İsim', translate: true)]
    public string $name = '';

    #[Validate('required|email', as: 'E-posta Adresi', translate: true)]
    public string $email = '';

    #[Validate('required', as: 'Telefon Numarası', translate: true)]
    public string $phone = '';

    #[Validate('required', as: 'Mesaj', translate: true)]
    public string $message = '';

    public ?string $classes = null;

    public ?string $title = null;
    public ?string $subtitle = null;

    public function mount($title, $subtitle)
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
    }

    public function save()
    {
        try {
            $this->rateLimit(maxAttempts: 2, decaySeconds: 10);
        } catch (TooManyRequestsException $exception) {
            Notification::make()
                ->title('Uyarı!')
                ->body('Formu çok fazla gönderiyorsunuz. Lütfen biraz bekleyin.')
                ->warning()
                ->send();

            return;
        }

        try {
            $this->validate();
        } catch (ValidationException $e) {
            $this->setErrorBag($e->errors());

            collect($e->errors())->each(function ($error, $key) {
                Notification::make()
                    ->title('Hata!')
                    ->body($error[0])
                    ->danger()
                    ->send();
            });

            return;
        }

        $extraData = [
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'referrer' => request()->headers->get('referer'),
        ];

        Form::create(array_merge($this->formEls(), $extraData));

        $recipients = [
            // 'ccmail@example.com',
        ];

        Mail::to('kt@kaantanis.com')
            ->cc($recipients)
            ->send(new ContactMail($this->name, $this->phone, $this->message));

        Notification::make()
            ->body('Mesajınız başarıyla iletildi')
            ->success()
            ->send();

        $this->reset();
    }

    public function formEls()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message,
        ];
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
