<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Hook extends Model
{
    protected $guarded = [];

     protected $casts = [
        'headers' => 'array'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('user_id', function (Builder $builder) {
            $builder->where('user_id', auth()->id());
        });
    }
}
