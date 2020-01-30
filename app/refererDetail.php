<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class refererDetail extends Model
{
    protected $fillable = [
        'short_urls_id', 'user_id', 'refer_name', 'referers_id','remote_addr','counter','request_at'
    ];
}
