
{{-- resources/views/emails/quote-request.blade.php --}}
@component('mail::message')
# Nouvelle Demande de Devis

## Informations du Client
**Nom:** {{ $data['name'] }}  
**Email:** {{ $data['email'] }}  
**Téléphone:** {{ $data['phone'] }}  
**Code Postal:** {{ $data['code'] }}

## Détails de la Demande
**Service Demandé:** {{ $data['service'] }}

## Message:
{{ $data['message'] }}

@component('mail::button', ['url' => config('app.url')])
Gérer la Demande
@endcomponent

Merci,<br>
{{ config('app.name') }}
@endcomponent