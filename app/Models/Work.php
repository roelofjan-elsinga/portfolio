<?php

namespace Main\Models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $table = 'works';
    protected $fillable = ['title', 'slug', 'summary', 'content', 'link', 'order', 'image_full', 'image_large', 'image_small'];
}
