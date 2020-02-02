<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['tag', 'slug'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
