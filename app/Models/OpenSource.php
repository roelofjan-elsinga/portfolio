<?php

namespace Main\Models;

use AloiaCms\Models\Model;

class OpenSource extends Model
{
    protected $folder = 'open_source_projects';

    protected $required_fields = [
        'name',
        'github_url',
        'description',
        'featured',
        'publish_date'
    ];
}
