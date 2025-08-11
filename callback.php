<?php

use myPHPnotes\Microsoft\Auth;
use myPHPnotes\Microsoft\Handlers\Session as MsSession;
use myPHPnotes\Microsoft\Models\User;

session_start();
require "vendor/autoload.php";

$auth = new Auth(
    MsSession::get("tenant_id"),
    MsSession::get("client_id"),
    MsSession::get("client_secret"),
    MsSession::get("redirect_uri"),
    MsSession::get("scopes")
);

$data = $auth->getToken($_REQUEST['code'], MsSession::get("state"));
$auth->setAccessToken($data->access_token);

// Obtener datos de usuario
$user = new User;

echo "<b>Nombre:</b> " . $user->data->getGivenName() . "<br>"; 
echo "<b>Display Name:</b> " . $user->data->getDisplayName() . "<br>"; 
echo "<b>Apellido:</b> " . $user->data->getSurname() . "<br>"; 
echo "<b>Email:</b> " . $user->data->getUserPrincipalName() . "<br>"; 
echo "<b>Ciudad:</b> " . $user->data->getCity() . "<br>"; 
echo "<b>Empresa:</b> " . $user->data->getCompanyName() . "<br>"; 
echo "<b>País:</b> " . $user->data->getCountry() . "<br>"; 
echo "<b>Cargo:</b> " . $user->data->getJobTitle() . "<br>"; 
echo "<b>Teléfono:</b> " . $user->data->getMobilePhone() . "<br>";
