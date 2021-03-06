<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    protected $fillable = [
        'code', 'url','title'
    ];

    public function referers()
    {
        return $this->hasMany('App\referer','short_urls_id');
    }
}
