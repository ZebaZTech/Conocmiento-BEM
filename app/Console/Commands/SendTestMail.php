<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SendTestMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:test {to}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envía un correo de prueba de Focus Work a la dirección indicada';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $to = (string) $this->argument('to');

        try {
            Mail::raw(
                "Correo de prueba de Focus Work.\n\n".
                'Mailer en uso: '.config('mail.default')."\n".
                'Fecha: '.now()->format('d/m/Y H:i')."\n".
                'URL de la aplicación: '.config('app.url'),
                function ($message) use ($to): void {
                    $message->to($to)->subject('Correo de prueba de Focus Work');
                }
            );
        } catch (Throwable $e) {
            $this->error('No se pudo enviar el correo de prueba: '.$e->getMessage());

            return self::FAILURE;
        }

        $this->info('Correo de prueba enviado a '.$to.' usando el mailer "'.config('mail.default').'".');

        return self::SUCCESS;
    }
}
