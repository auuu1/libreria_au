<?php

namespace App\Observers;

use App\Models\Libro;
use App\Services\GmailService;

class ContactoObserver
{
    public function created(Libro $libro)
    {
        $service = new GmailService();

        $service->sendEmail(
            'tu-correo-destino@gmail.com',
            'Nuevo Libro Registrado',
            "Se ha insertado el libro: <strong>{$libro->titulo}</strong>"
        );
    }

    public function updated(Libro $libro): void {}

    public function deleted(Libro $libro): void {}

    public function restored(Libro $libro): void {}

    public function forceDeleted(Libro $libro): void {}
}
