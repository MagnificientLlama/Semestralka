<?php
session_start();
require_once '../vendor/autoload.php';
$fb = new Facebook\Facebook([
'app_id' => '2398891117009090',
'app_secret' => 'be568400f92fbfc7ad044e2f09d669b7',
'default_graph_version' => 'v2.10',
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('https://eso.vse.cz/~zemp02/Semestralka/Facebook/fb-login-callback.php', $permissions);

header('Location:'.$loginUrl);