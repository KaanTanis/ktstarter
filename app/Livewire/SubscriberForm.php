<?php

namespace App\Livewire;

use App\Models\SubscriberForm as ModelsSubscriberForm;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Filament\Notifications\Notification;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SubscriberForm extends Component
{
    use WithRateLimiting;

    #[Validate('required|email|unique:subscriber_forms', as: 'E-posta Adresi', translate: true)]
    public string $email = '';

    public function save()
    {
        try {
            $this->rateLimit(maxAttempts: 1, decaySeconds: 10);
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

        $formData = [
            'email' => $this->email,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'referrer' => request()->headers->get('referer'),
        ];

        ModelsSubscriberForm::create($formData);

        Notification::make()
            ->title('Abone olundu!')
            ->body('Son güncellemer e-posta adresinize gönderilecek.')
            ->success()
            ->send();

        $this->reset();
    }

    public function render()
    {
        return view('livewire.subscriber-form');
    }
}
