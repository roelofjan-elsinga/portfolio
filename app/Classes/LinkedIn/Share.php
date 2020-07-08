<?php


namespace Main\Classes\LinkedIn;

use GuzzleHttp\Client;
use Main\Classes\LinkedIn\Sharing\Article;

class Share
{
    private string $access_token;

    public function withAccessToken(string $access_token): Share
    {
        $this->access_token = $access_token;

        return $this;
    }

    public function article(string $post_content, string $article_url, string $title, string $description): Article
    {
        return new Article($this->access_token, $this->retrieveUserId(), $post_content, $article_url, $title, $description);
    }

    private function retrieveUserId(): string
    {
        $client = new Client();

        $response = $client->get(LinkedIn::ME_ENDPOINT, [
            'headers' => [
                'Authorization' => "Bearer {$this->access_token}"
            ]
        ]);

        $response_data = json_decode($response->getBody()->getContents(), true);

        return $response_data['id'];
    }

}