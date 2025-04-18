@component('mail::message')
# Yeni İletişim Mesajı

**İsim:** {{ $name }}

**Telefon:** {{ $phone }}

**Mesaj:**  
{{ $messageText }}

@endcomponent
