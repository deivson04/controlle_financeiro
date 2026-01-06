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

        // Certificado SSL
        $caminho_certificado = __DIR__ . '/cacert.pem';
        if (file_exists($caminho_certificado)) {
            $this->client->setHttpClient(
                new GuzzleClient(['verify' => $caminho_certificado])
            );
        }

        // Credenciais Google
        $this->client->setClientId(trim($_ENV['GOOGLE_CLIENT_ID']));
        $this->client->setClientSecret(trim($_ENV['GOOGLE_CLIENT_SECRET']));

        // Redirect URI (PC ou Android)
        $redirectUri = trim($_ENV['GOOGLE_REDIRECT_URI_PC']);
        // $redirectUri = trim($_ENV['GOOGLE_REDIRECT_URI_ANDROID']);

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
