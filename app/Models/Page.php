<?php

namespace Main\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model{
    protected $table = 'pages';
    protected $fillable = ['name', 'slug', 'title', 'content', 'keywords', 'description', 'user_id', 'image_large', 'image_small'];

    public function user() {
        return $this->belongsTo('Main\Models\User', 'id', 'user_id');
    }
}
