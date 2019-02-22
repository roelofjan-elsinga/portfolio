<?php

namespace Main\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    protected $fillable = ['icon', 'title', 'content', 'order'];
}
