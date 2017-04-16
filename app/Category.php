<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'body',
        'is_active',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function active()
    {
        return self::select('id', 'name')->where('is_active', true)->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
