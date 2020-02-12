<?php

namespace Main\Models;

use FlatFileCms\Models\Model;

class Work extends Model
{
    protected $folder = 'work';

    protected $required_fields = [
        'image_url',
        'image_alt',
        'title',
        'description',
        'url'
    ];

    public function keywords(): string
    {
        return $this->matter['title'];
    }

    public function author(): string
    {
        return 'Roelof Jan Elsinga';
    }

    public function thumbnail(): string
    {
        return 'https://roelofjanelsinga.com/images/logo/logo_banner.jpg';
    }

    public function image(): string
    {
        return 'https://roelofjanelsinga.com/images/logo/logo_banner.jpg';
    }
}
