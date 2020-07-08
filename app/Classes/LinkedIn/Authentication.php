<?php


namespace Main\Classes\LinkedIn;


class Authentication
{
    private string $response_type;
    private string $client_key;
    private string $redirect_uri;
    private string $state;
    private array $scope;

    public function __construct(string $response_type, string $client_key, string $redirect_uri, string $state, array $scope)
    {
        $this->response_type = $response_type;
        $this->client_key = $client_key;
        $this->redirect_uri = $redirect_uri;
        $this->state = $state;
        $this->scope = $scope;
    }

    public function redirectUrl(): string
    {
        $query_parameters = [
            'response_type' => $this->response_type,
            'client_id' => $this->client_key,
            'redirect_uri' => $this->redirect_uri,
            'scope' => implode(" ", $this->scope),
        ];

        if (!empty($this->state)) {
            $query_parameters['state'] = $this->state;
        }

        $path = http_build_query($query_parameters);

        return LinkedIn::AUTHENTICATION_ENDPOINT . '?' . $path;
    }

    public function hasValidState(string $state): bool
    {
        return $this->state === $state;
    }
}