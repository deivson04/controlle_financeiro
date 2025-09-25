<?php

require_once "../vendor/autoload.php";

class GoogleClient {
    
    
    
    public function clientGoogle() {
        
    
   $client = new Google_Client();

// Substitua com as suas credenciais do Google Cloud Console
$client->setClientId("");

$client->setClientSecret("");

// O URI para onde o usuário será redirecionado após o login
// Deve ser o mesmo URI configurado no Google Cloud Console

$redirectUri = 'https://manufacturers-engagement-updating-bradford.trycloudflare.com/View/dashboardView.php';

$client->setRedirectUri($redirectUri);

// Define o escopo das informações que você quer acessar do usuário
$client->addScope('email');
$client->addScope('profile');

$authUrl = $client->createAuthUrl();

return $authUrl;

}
  }