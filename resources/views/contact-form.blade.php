@if (session('mail_debug') && app()->environment('local'))
    <div class="mail-debug-info"
        style="margin-bottom: 20px; padding: 15px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 4px;">
        <h6 style="margin: 0 0 10px; color: #4a5568; font-size: 0.875rem;">Informations de Débogage Email</h6>
        <div style="font-family: monospace; font-size: 0.875rem;">
            <div>Status: <span style="color: {{ session('mail_debug')['sent'] ? '#047857' : '#dc2626' }}">
                    {{ session('mail_debug')['sent'] ? '✓ Envoyé' : '✗ Échec' }}
                </span></div>
            <div>Driver: {{ session('mail_debug')['driver'] }}</div>
            <div>Host: {{ session('mail_debug')['host'] }}</div>
            <div>Port: {{ session('mail_debug')['port'] }}</div>
            <div>Encryption: {{ session('mail_debug')['encryption'] }}</div>
            <div>From: {{ session('mail_debug')['from'] }}</div>
            <div>To: {{ session('mail_debug')['to'] }}</div>
            @if (session('mail_debug')['error'] ?? false)
                <div
                    style="margin-top: 10px; padding: 10px; background: #fef2f2; border: 1px solid #fee2e2; border-radius: 4px; color: #dc2626;">
                    Erreur: {{ session('mail_debug')['error'] }}
                </div>
            @endif
        </div>
    </div>
@endif
<form id="ttm-quote-form" class="ttm-quote-form wrap-form clearfix" method="post" action="{{ route('contact.store') }}">
    @csrf
    <input type="hidden" name="type" value="{{ request()->has('devis') ? 'devis' : 'contact' }}">

    {{-- Display success message if exists --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Display error message if exists --}}
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-lg-6">
            <label>
                <span class="text-input">
                    <input name="name" type="text" value="{{ old('name') }}" placeholder="Nom Complet"
                        required="required">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </span>
            </label>
        </div>
        <div class="col-lg-6">
            <label>
                <span class="text-input">
                    <input name="email" type="email" value="{{ old('email') }}" placeholder="Adresse Email"
                        required="required">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </span>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <label>
                <span class="text-input">
                    <input name="phone" type="tel" value="{{ old('phone') }}" placeholder="Numéro de Téléphone"
                        required="required">
                    @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </span>
            </label>
        </div>
        <div class="col-lg-6">
            <label>
                <span class="text-input">
                    <input name="code" type="text" value="{{ old('code') }}" placeholder="Code Postal"
                        required="required">
                    @error('code')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </span>
            </label>
        </div>
    </div>

    @if (request()->has('devis'))
        <label>
            <span class="text-input">
                <select name="service" required="required">
                    <option value="">Sélectionnez un Service</option>
                    @foreach ($services as $service)
                        <option value="{{ $service->name }}" {{ old('service') == $service->name ? 'selected' : '' }}>
                            {{ $service->name }}
                        </option>
                    @endforeach
                </select>
                @error('service')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </span>
        </label>
    @endif

    <label>
        <span class="text-input">
            <textarea name="message" rows="4" placeholder="Votre Message" required="required">{{ old('message') }}</textarea>
            @error('message')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </span>
    </label>

    <input name="submit" type="submit" id="submit" class="submit"
        value="{{ request()->has('devis') ? 'OBTENIR UN DEVIS GRATUIT' : 'ENVOYER LE MESSAGE' }}">
</form>

<style>
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }

    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }

    .text-danger {
        color: #dc3545;
        font-size: 0.875em;
        margin-top: 5px;
        display: block;
    }

    .ttm-quote-form input.error,
    .ttm-quote-form textarea.error,
    .ttm-quote-form select.error {
        border-color: #dc3545;
    }

    .ttm-quote-form input:focus,
    .ttm-quote-form textarea:focus,
    .ttm-quote-form select:focus {
        outline: none;
        border-color: var(--skin-color);
        box-shadow: 0 0 0 0.2rem rgba(var(--skin-color-rgb), 0.25);
    }
</style>
