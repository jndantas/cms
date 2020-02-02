<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['site_name', 'address', 'contact_number', 'contact_email', 'country', 'disponible', 'logo', 'youtube', 'instagram', 'twitter', 'facebook'];
}
