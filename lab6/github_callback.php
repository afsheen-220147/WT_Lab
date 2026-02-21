<?php
session_start();

$client_id = "Ov23li27yzABMHOyxWWH";
$client_secret = "f55d28f2cfcbad8287b7a8bcefb632198e831b45";

if (!isset($_GET['code'])) {
    echo "No code received from GitHub";
    exit;
}

$code = $_GET['code'];

/* Exchange code for access token */
$token_response = file_get_contents(
    "https://github.com/login/oauth/access_token",
    false,
    stream_context_create([
        "http" => [
            "method" => "POST",
            "header" => "Accept: application/json",
            "content" => http_build_query([
                "client_id" => $client_id,
                "client_secret" => $client_secret,
                "code" => $code
            ])
        ]
    ])
);

$token_data = json_decode($token_response, true);

if (!isset($token_data['access_token'])) {
    echo "Failed to get GitHub access token";
    exit;
}

$access_token = $token_data['access_token'];

/* Fetch GitHub user info */
$user_info = json_decode(
    file_get_contents(
        "https://api.github.com/user", false,
        stream_context_create([
            "http" => [
                "header" => "User-Agent: PHP-App\r\nAuthorization: token $access_token"
            ]
        ])
    ),
    true
);

$_SESSION['github_user'] = $user_info['login'];

header("Location: index.php");
exit;