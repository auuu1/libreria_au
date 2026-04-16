<?php

namespace App\Services;
use Google\Client;
use Google\Service\Gmail;
use Google\Service\Gmail\Message;
use Illuminate\Support\Facades\Storage;

class GmailService {
    protected $client;

public function __construct() {
    $this->client = new \Google\Client();
    $this->client->setClientId(env('GOOGLE_CLIENT_ID'));
    $this->client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
    $this->client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
    $this->client->addScope(\Google\Service\Gmail::GMAIL_SEND);
    $this->client->setAccessType('offline');
    $this->client->setPrompt('consent');
}

    public function getAuthUrl() {
        return $this->client->createAuthUrl();
    }

public function saveToken($code) {
    $token = $this->client->fetchAccessTokenWithAuthCode($code);


    if (isset($token['error'])) {
        throw new \Exception('Error al obtener token: ' . $token['error']);
    }


    $guardado = \Illuminate\Support\Facades\Storage::put(
        'gmail_token.json',
        json_encode($token)
    );

    
    if (!$guardado) {
        throw new \Exception('No se pudo guardar el token');
    }

    return $token;
}

    public function sendEmail($to, $subject, $body) {
        $token = json_decode(Storage::get('gmail_token.json'), true);
        $this->client->setAccessToken($token);

        // Si el token expiro, lo renovamos sin molestar al usuario
        if ($this->client->isAccessTokenExpired()) {
            $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
            Storage::put('gmail_token.json', json_encode($this->client->getAccessToken()));
        }

        $gmail = new Gmail($this->client);
        $rawMessage = base64_encode("To: $to\r\nSubject: $subject\r\nContent-Type: text/html; charset=utf-8\r\n\r\n$body");
        $rawMessage = str_replace(['+', '/', '='], ['-', '_', ''], $rawMessage);

        $message = new Message();
        $message->setRaw($rawMessage);
        return $gmail->users_messages->send('me', $message);
    }
}