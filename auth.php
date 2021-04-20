<?php
require_once __DIR__.'/vendor/autoload.php';
 
session_start();
 
$client = new Google_Client();
$client->setAuthConfigFile('client_secret.json');
$client->setRedirectUri("http://localhost/LaundryYuk/auth.php");
$client->setScopes(array(
    "https://www.googleapis.com/auth/contacts",
    "https://www.googleapis.com/auth/contacts.readonly",
    "https://www.googleapis.com/auth/directory.readonly",
    "https://www.googleapis.com/auth/profile.emails.read",
    "https://www.googleapis.com/auth/userinfo.email",
    "https://www.googleapis.com/auth/userinfo.profile",
    
    
));
 
if (!isset($_GET['code'])) {
  $auth_url = $client->createAuthUrl();
  header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
} else {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
   
  try {
      // profile
      $plus = new Google_Service_PeopleService($client);
      $_SESSION['access_profile'] = $plus->people->get("profile");
  } catch (\Exception $e) {
      echo $e->__toString();

      $_SESSION['access_token'] = "";
      die;
  }
 
  header('Location:index.php');
}