{{-- resources/views/emails/contact-form.blade.php --}}
@component('mail::message')
# Nouveau Message de Contact

**De:** {{ $data['name'] }}  
**Email:** {{ $data['email'] }}  
**Sujet:** {{ $data['subject'] }}

## Message:
{{ $data['message'] }}

@component('mail::button', ['url' => config('app.url')])
Visiter le Site
@endcomponent

Merci,<br>
{{ config('app.name') }}
@endcomponent