<?php

namespace Model;

use Dotenv\Dotenv;
use Google\Client;
use Google\Service\Oauth2;
use GuzzleHttp\Client as GuzzleClient;

class GoogleAuthRepository
{
    protected Client $client;

    public function __construct()
    {
        // Carrega variáveis de ambiente
        $dotenv = Dotenv::createImmutable(__DIR__ . '/..');
        $dotenv->safeLoad();

        $this->client = new Client();

        $caminho_certificado = __DIR__ . '/cacert.pem';


        //$redirectUri = trim($_ENV['GOOGLE_REDIRECT_URI_ANDROID']);
        $redirectUri = trim($_ENV['GOOGLE_REDIRECT_URI_PRODUCAO']);
        $this->client->setRedirectUri($redirectUri);

        // Escopos
        $this->client->addScope('email');
        $this->client->addScope('profile');
    }

    public function googleAuthLogin(): string
    {
        return $this->client->createAuthUrl();
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function googleCallback(string $authCode): ?array
    {
        try {
            $token = $this->client->fetchAccessTokenWithAuthCode($authCode);

            if (isset($token['error'])) {
                error_log('Erro ao trocar token: ' . $token['error']);
                return null;
            }

            $this->client->setAccessToken($token);

            $oauth2 = new Oauth2($this->client);
            $userInfo = $oauth2->userinfo->get();

            return [
                'id_google' => $userInfo->id,
                'nome'      => $userInfo->name,
                'email'     => $userInfo->email
            ];

        } catch (\Exception $e) {
            error_log('Erro Google Callback: ' . $e->getMessage());
            return null;
        }
    }
}
