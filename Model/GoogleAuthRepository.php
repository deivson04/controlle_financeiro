<?php

namespace Model;

use Dotenv\Dotenv;
use Google\Client;
use Google\Service\Oauth2;

class GoogleAuthRepository {

    protected $client;

    public function __construct() {
        
      $dotenv = Dotenv::createImmutable(__DIR__ . '/..');
      $dotenv->safeLoad();

        $this->client = new Client();

        $idClient = $_ENV['GOOGLE_CLIENT_ID'];
        $secretClient = $_ENV['GOOGLE_CLIENT_SECRET'];
        $this->client->setClientId($idClient);
        $this->client->setClientSecret($secretClient);

        // URL de Redirecionamento
        $redirectUri = 'https://range-broader-homeless-basename.trycloudflare.com/View/DashboardView.php';
        $this->client->setRedirectUri($redirectUri);

        // Define os escopos de acesso
        $this->client->addScope('email');
        $this->client->addScope('profile');
      
       }
    
    public function googleAuthLogin() {
     
        return $this->client->createAuthUrl(); 
    }
    
    // Adicionar o método para obter a instância (para callbacks)
    public function getClient(): Client {
        return $this->client;
    }
    
    
    public function googleCallback($authCode) {
        
        // 1. Troca o código por um Token de Acesso
        try {
            // Usa o $this->client diretamente (melhor que o getClient() aqui)
            $token = $this->client->fetchAccessTokenWithAuthCode($authCode);
            
            if (isset($token['error'])) {
                error_log('Erro ao trocar o token: ' . $token['error']);
                return null;
            }

        } catch (\Exception $e) {
            error_log('Exceção ao trocar o token: ' . $e->getMessage());
            return null;
        }

        // 2. Define o Token de Acesso
        $this->client->setAccessToken($token);

        // 3. Usa o serviço Oauth2 (que precisa do $this->client)
        $googleOauth = new Oauth2($this->client);
        $userInfo = $googleOauth->userinfo->get();

        // 4. Retorna os dados que você precisa (incluindo o nome!)
        return [
            'id_google' => $userInfo->id,
            'nome'      => $userInfo->name, // 🔑 O NOME ESTÁ AQUI
            'email'     => $userInfo->email,
            'foto'      => $userInfo->picture ?? null
        ];
}