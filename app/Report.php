<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class Report extends Model
{
    use HasMediaTrait;

    protected $fillable = [
        'name',
        'prename',
        'address',
        'body',
        'category_id',
    ];

}
