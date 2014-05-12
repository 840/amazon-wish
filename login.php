<?php


session_start();
require_once('./twitteroauth/twitteroauth.php');

$sConsumerKey = "AbQLk4gVwV1gs94YmTtw";

$sConsumerSecret = "EZrzbXcoW1f9D3e0xLvBYSa5Fz25ztWPZo1SUr8yic";

$sCallBackUrl = '133.208.22.43/amazon-wish/callback.php';

if((isset($_SESSION['oauthToken']) && $_SESSION['oauthToken'] !== NULL) && (isset($_SESSION['oauthTokenSecret']) && $_SESSION['oauthTokenSecret'] !== NULL)){

    $sUserId = $_SESSION['userId'];
    $sScreenName = $_SESSION['screenName'];

    echo $sUserId;
    echo $sScreenName;

}else{

    $oOauth = new TwitterOAuth($sConsumerKey,$sConsumerSecret);
    $oOauthToken = $oOauth->getRequestToken($sCallBackUrl);

    $_SESSION['requestToken'] = $sToken = $oOauthToken['oauth_token'];
    $_SESSION['requestTokenSecret']=
        $oOauthToken['oauth_token_secret'];

    //認証URLの引数 falseの場合はtwitter側で認証確認表示
    if(isset($_GET['authorizeBoolean']) && $_GET['authorizeBoolean'] != '')
        $bAuthorizeBoolean = false;
    else
        $bAuthorizeBoolean = true;

    $sUrl = $oOauth->getAuthorizeURL($sToken, $bAuthorizeBoolean);
    header("Location: $sUrl");
}
?>