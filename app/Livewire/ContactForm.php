<?php

namespace App\Livewire;

use App\Models\Form;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Filament\Notifications\Notification;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ContactForm extends Component
{
    use WithRateLimiting;

    #[Validate('required', as: 'İsim', translate: true)]
    public string $name = '';

    #[Validate('required|email', as: 'E-posta Adresi', translate: true)]
    public string $email = '';

    #[Validate('required', as: 'Telefon Numarası', translate: true)]
    public string $phone = '';

    #[Validate('required', as: 'Hizmetler', translate: true)]
    public array $services = [];

    #[Validate('required|in:0,25,50,75', as: 'Bütçe', translate: true)]
    public int $budget = 25;

    #[Validate('required', as: 'Mesaj', translate: true)]
    public string $message = '';

    public ?string $classes = null;

    public function save()
    {
        try {
            $this->rateLimit(maxAttempts: 2, decaySeconds: 10);
        } catch (TooManyRequestsException $exception) {
            Notification::make()
                ->title('Bodyguard geldi!')
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

        Notification::make()
            ->title('Başarılı!')
            ->body('Form başarıyla gönderildi.')
            ->success()
            ->send();

        $this->reset();

        $this->dispatch('contact-form:submitted');
    }

    public function formEls()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'services' => $this->services,
            'budget' => $this->budget,
            'message' => $this->message,
        ];
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
