<?php
session_start();

if (!isset($_SESSION['fb_access_token'])) {
    header('Location: index.php');
    die();
}

require_once '../vendor/autoload.php';
require_once '../generated-conf/config.php';

$fb = new \Facebook\Facebook(array_merge([
    'app_id' => '2398891117009090',
    'app_secret' => 'be568400f92fbfc7ad044e2f09d669b7',
    'default_graph_version' => 'v2.10',
]), ['default_access_token' => $_SESSION['fb_access_token']]);
try {
    $me = $fb->get('/me')->getGraphUser();
    $picture = $fb->get('/me/picture?redirect=false&height=200')->getGraphUser();
} catch(\Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(\Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

$_SESSION['username']=$me->getName();
$user =UserQuery::create()->findOneByUsername($me->getName());
if($user==NULL){
    $email=trim($me->getName()).'@kek.cz';
    $password=$me->getName().$me->getId();
    $nuser = new User();
    $nuser->setUsername($me->getName());
    $nuser->setEmail($email);
    $nuser->setPassword(password_hash($password,PASSWORD_DEFAULT));
    $nuser->setUseravatar($picture['url']);
    $nuser->save();
    $nuser->reload();
    $readingList = new Readinglist();
    $readingList->setRlname('ReadingList');
    $readingList->setUserUserid1($nuser->getUserid());
    $readingList->save();

    $_SESSION['userID'] = $nuser->getUserid();
    $_SESSION['username'] = $nuser->getUsername();
    $_SESSION['userPrivilegy'] = $nuser->getPrivilegy();

    echo $user;
}else{
    $nuser =UserQuery::create()->findOneByUsername($me->getName());
    $_SESSION['userID'] = $nuser->getUserid();
    $_SESSION['username'] = $nuser->getUsername();
    $_SESSION['userPrivilegy'] = $nuser->getPrivilegy();
}
header('Location: ../index.php');
die();
?>