<?php

namespace Main\Classes\LinkedIn\Sharing;

use GuzzleHttp\Client;
use Main\Classes\LinkedIn\LinkedIn;

class Article
{
    private string $access_token;
    private string $user_id;
    private string $post_content;
    private string $article_url;
    private string $title;
    private string $description;

    public function __construct(string $access_token, string $user_id, string $post_content, string $article_url, string $title, string $description)
    {
        $this->access_token = $access_token;
        $this->user_id = $user_id;
        $this->post_content = $post_content;
        $this->article_url = $article_url;
        $this->title = $title;
        $this->description = $description;
    }

    public function publicly(): array
    {
        return $this->buildRequest("PUBLIC");
    }

    public function toConnections(): array
    {
        return $this->buildRequest("CONNECTIONS");
    }

    private function buildRequest(string $network_visibility): array
    {
        $client = new Client();

        $response = $client
            ->post(LinkedIn::SHARE_ENDPOINT, [
                'headers' => [
                    'X-Restli-Protocol-Version' => '2.0.0',
                    'Authorization' => "Bearer {$this->access_token}"
                ],
                'json' => [
                    "author" => "urn:li:person:{$this->user_id}",
                    "lifecycleState" => "PUBLISHED",
                    "specificContent" => [
                        "com.linkedin.ugc.ShareContent" => [
                            "shareCommentary" => [
                                "text" => $this->post_content
                            ],
                            "shareMediaCategory" => "ARTICLE",
                            "media" => [
                                [
                                    "status" => "READY",
                                    "description" => [
                                        "text" => $this->description
                                    ],
                                    "originalUrl" => $this->article_url,
                                    "title" => [
                                        "text" => $this->title
                                    ]
                                ]
                            ]
                        ]
                    ],
                    "visibility" => [
                        "com.linkedin.ugc.MemberNetworkVisibility" => $network_visibility
                    ]
                ]
            ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}