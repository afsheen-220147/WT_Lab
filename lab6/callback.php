<?php
session_start();

$client_id = "744841037089-81huto05a599sn58dl2psk78cpgls930.apps.googleusercontent.com";
$client_secret = "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";
$redirect_uri = "http://localhost/AUTH/lab6/callback.php";

if (!isset($_GET['code'])) {
    echo "No authorization code received";
    exit;
}

$code = $_GET['code'];

$token_url = "https://oauth2.googleapis.com/token";

$post_data = [
    "code" => $code,
    "client_id" => $client_id,
    "client_secret" => $client_secret,
    "redirect_uri" => $redirect_uri,
    "grant_type" => "authorization_code"
];

$options = [
    "http" => [
        "method"  => "POST",
        "header"  => "Content-Type: application/x-www-form-urlencoded",
        "content" => http_build_query($post_data)
    ]
];

$context = stream_context_create($options);
$response = file_get_contents($token_url, false, $context);
$token_data = json_decode($response, true);

if (!isset($token_data['access_token'])) {
    print_r($token_data);
    exit;
}

$user_info = json_decode(
    file_get_contents(
        "https://www.googleapis.com/oauth2/v2/userinfo?access_token=" . $token_data['access_token']
    ),
    true
);

$_SESSION['email'] = $user_info['email'];
$_SESSION['name']  = $user_info['name'];

header("Location: index.php");
exit;