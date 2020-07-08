<?php


namespace Main\Classes\LinkedIn;


use GuzzleHttp\Client;

class AccessToken
{
    private string $grant_type;
    private string $redirect_uri;
    private string $client_key;
    private string $client_secret;

    public function __construct(string $grant_type, string $redirect_uri, string $client_key, string $client_secret)
    {
        $this->grant_type = $grant_type;
        $this->redirect_uri = $redirect_uri;
        $this->client_key = $client_key;
        $this->client_secret = $client_secret;
    }

    public function retrieve(string $authorization_code): array
    {
        $client = new Client();

        $response = $client->post(LinkedIn::ACCESS_TOKEN_ENDPOINT, [
            'form_params' => [
                'grant_type' => $this->grant_type,
                'code' => $authorization_code,
                'redirect_uri' => $this->redirect_uri,
                'client_id' => $this->client_key,
                'client_secret' => $this->client_secret
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

}