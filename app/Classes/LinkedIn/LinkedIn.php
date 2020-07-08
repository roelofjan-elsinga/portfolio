<?php


namespace Main\Classes\LinkedIn;

use GuzzleHttp\Client;

class LinkedIn
{
    const AUTHENTICATION_ENDPOINT = 'https://www.linkedin.com/oauth/v2/authorization';
    const ACCESS_TOKEN_ENDPOINT = 'https://www.linkedin.com/oauth/v2/accessToken';
    const SHARE_ENDPOINT = 'https://api.linkedin.com/v2/ugcPosts';
    const ME_ENDPOINT = 'https://api.linkedin.com/v2/me';

    private string $client_key;
    private string $client_secret;
    private string $response_type;
    private string $redirect_uri;
    private string $state;
    private array $scope;
    private string $grant_type;

    public function __construct(string $client_key, string $client_secret, string $redirect_uri)
    {
        $this->client_key = $client_key;
        $this->client_secret = $client_secret;
        $this->response_type = 'code';
        $this->redirect_uri = $redirect_uri;
        $this->state = '';
        $this->scope = ['r_liteprofile', 'w_member_social'];
        $this->grant_type = 'authorization_code';
    }

    public function scope(array $scope): LinkedIn
    {
        $this->scope = $scope;

        return $this;
    }

    public function state(string $state): LinkedIn
    {
        $this->state = $state;

        return $this;
    }

    public function authentication(): Authentication
    {
        return new Authentication(
            $this->response_type,
            $this->client_key,
            $this->redirect_uri,
            $this->state,
            $this->scope
        );
    }

    public function accessToken(): AccessToken
    {
        return new AccessToken(
            $this->grant_type,
            $this->redirect_uri,
            $this->client_key,
            $this->client_secret
        );
    }

    public function share(): Share
    {
        return new Share();
    }
}
