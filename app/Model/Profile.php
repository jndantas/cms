<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['user_id', 'avatar', 'linkedin', 'facebook', 'twitter', 'instagram', 'about'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
