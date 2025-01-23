<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Exception;
use Symfony\Component\Mailer\Exception\TransportException;

class ContactController extends Controller
{
    public function store(ContactFormRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            // Test SMTP connection first
            $transport = Mail::mailer()->getSymfonyTransport();
            if (method_exists($transport, 'start')) {
                $transport->start();
            }

            $mail = new ContactFormMail($validated);

            $mailConfig = [
                'driver' => config('mail.default'),
                'host' => config('mail.mailers.smtp.host'),
                'port' => config('mail.mailers.smtp.port'),
                'encryption' => config('mail.mailers.smtp.encryption'),
                'from' => config('mail.from.address'),
                'to' => config('mail.admin_address')
            ];

            Log::info('Attempting to send contact form mail', $mailConfig);

            Mail::to(config('mail.admin_address'))->send($mail);

            Log::info('Contact form mail sent successfully', [
                'subject' => $validated['subject'],
                'config' => $mailConfig
            ]);

            return redirect()
                ->back()
                ->with('success', 'Votre message a été envoyé avec succès! Nous vous contacterons bientôt.')
                ->with('mail_debug', [
                    'sent' => true,
                    'driver' => $mailConfig['driver'],
                    'host' => $mailConfig['host'],
                    'port' => $mailConfig['port'],
                    'encryption' => $mailConfig['encryption'],
                    'from' => $mailConfig['from'],
                    'to' => $mailConfig['to']
                ]);

        } catch (TransportException $e) {
            Log::error('Mail transport error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'data' => $validated
            ]);

            return $this->handleError(
                $e,
                $validated,
                'Erreur de connexion au serveur mail: ' . $this->getReadableError($e->getMessage())
            );

        } catch (Exception $e) {
            Log::error('Mail error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'data' => $validated
            ]);

            return $this->handleError($e, $validated);
        }
    }

    private function handleError(Exception $e, array $data, string $message = null): RedirectResponse
    {
        $mailConfig = [
            'driver' => config('mail.default'),
            'host' => config('mail.mailers.smtp.host'),
            'port' => config('mail.mailers.smtp.port'),
            'encryption' => config('mail.mailers.smtp.encryption'),
            'from' => config('mail.from.address'),
            'to' => config('mail.admin_address')
        ];

        return redirect()
            ->back()
            ->with('error', $message ?? 'Une erreur est survenue lors de l\'envoi. Veuillez réessayer plus tard.')
            ->with('mail_debug', [
                'sent' => false,
                'error' => app()->environment('local') ? $e->getMessage() : null,
                'driver' => $mailConfig['driver'],
                'host' => $mailConfig['host'],
                'port' => $mailConfig['port'],
                'encryption' => $mailConfig['encryption'],
                'from' => $mailConfig['from'],
                'to' => $mailConfig['to']
            ])
            ->withInput();
    }

    private function getReadableError(string $error): string
    {
        if (str_contains($error, 'Connection could not be established')) {
            return 'Impossible de se connecter au serveur mail. Vérifiez vos paramètres de connexion.';
        }
        if (str_contains($error, 'Connection timed out')) {
            return 'La connexion au serveur mail a expiré. Vérifiez votre connexion internet.';
        }
        if (str_contains($error, 'Authentication failed')) {
            return 'Échec de l\'authentification. Vérifiez vos identifiants mail.';
        }
        return 'Une erreur est survenue lors de la connexion au serveur mail.';
    }
}