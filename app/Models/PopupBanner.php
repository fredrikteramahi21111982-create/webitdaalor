<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PopupBanner extends Model
{
    protected $fillable = [
        'title',
        'image_path',
        'url',
        'is_active',
    ];
}
