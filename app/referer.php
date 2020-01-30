<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class referer extends Model
{
    protected $fillable = [
        'short_urls_id', 'user_id', 'refer_name', 'counter'
    ];

    public function refererDetails()
    {
        return $this->hasMany('App\refererDetail','referers_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
