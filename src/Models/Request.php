<?php

namespace LaravelRequest\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    //


    public function user()
    {
        return $this->belongsTo(config('auth.model')?config('auth.model'):config('auth.providers.users.model'));
    }
}
