<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'address',
        'email',
        'whatsapp',
        'facebook',
        'instagram',
        'youtube',
        'tiktok',
        'linkedin',
        'map_url',
        'instagram_widget_code',
        'foreword_title',
        'foreword_name',
        'foreword_position',
        'foreword_content',
        'foreword_image',
    ];
}
