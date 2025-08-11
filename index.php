<?php
session_start();
require "vendor/autoload.php";
require "Environment.php";

use myPHPnotes\Microsoft\Auth;
use myPHPnotes\Microsoft\Handlers\Session as MsSession;

$env = new Environment(__DIR__ . '/.env');

// Guardar en la sesión de Microsoft
MsSession::set("tenant_id", $env->get('TENANT'));
MsSession::set("client_id", $env->get('CLIENT_ID'));
MsSession::set("client_secret", $env->get('CLIENT_SECRET'));
MsSession::set("redirect_uri", $env->get('CALLBACK_URL'));
MsSession::set("scopes", explode(',', $env->get('SCOPES', 'User.Read')));

$microsoft = new Auth(
    $env->get('TENANT'),
    $env->get('CLIENT_ID'),
    $env->get('CLIENT_SECRET'),
    $env->get('CALLBACK_URL'),
    explode(',', $env->get('SCOPES', 'User.Read'))
);

header("Location: " . $microsoft->getAuthUrl());
exit;
