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
        if (file_exists($caminho_certificado)) {
            $guzzleClient = new \GuzzleHttp\Client(['verify' => $caminho_certificado]);
        } else {
            // Em produção, o servidor geralmente já tem isso configurado
            $guzzleClient = new \GuzzleHttp\Client(['verify' => true]);
        }
        
        $this->client->setHttpClient($guzzleClient);


        $clientId     = trim($_ENV['GOOGLE_CLIENT_ID'] ?? '');
        $clientSecret = trim($_ENV['GOOGLE_CLIENT_SECRET'] ?? '');
        $redirectUri  = trim($_ENV['GOOGLE_REDIRECT_URI_PRODUCAO'] ?? '');
       
        $this->client->setClientId($clientId);
        $this->client->setClientSecret($clientSecret);
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
