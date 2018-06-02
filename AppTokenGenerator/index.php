<?php 

require '../vendor/autoload.php';

$client = new GuzzleHttp\Client;

try {
    $response = $client->post('localhost:8000/oauth/token', [
        'form_params' => [
            'client_id' => 3,
            'client_secret' => 'E4xSpAnJwyfRTEfTaENVZpgReZgeL06QeezrdXL2',
            'grant_type' => 'password',
            'username' => 'app@m.app',
            'password' => 'secret',
            'scope' => '*',
        ]
    ]);

    $auth = json_decode((string) $response->getBody());

    $response = $client->get('localhost:8000/api/v1/user', [
        'headers' => [
            'Authorization' => 'Bearer '.$auth->access_token,
        ]
    ]);

    $user = json_decode((string) $response->getBody());

    echo $user;

} catch (GuzzleHttp\Exception\BadResponseException $e) {
    echo "Unable to retrieve access token" . $e->getMessage();
}

?>