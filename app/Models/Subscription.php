<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
  public $guarded = [];

    protected $casts = [
        'published_at' => 'datetime',
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
        'annual_price' => 'integer'
    ];

    public $appends = ['id_active'];

    public function scopePublished($query)
    {
        return $query
        ->where([
            'is_published' => true,
        ]);
    }

    public function scopeActive($query)
    {
    	$now = date("Y-m-d");

        return $query
        ->whereDate('starts_at' ,'<=', $now)
        ->whereDate('expires_at', '>=', $now);
    }


    public function getIsActiveAttribute($value){
        $now = date("Y-m-d");
        return (
            $this->starts_at <= $now
            && $this->expires_at >= $now
        );
    }

    public function scopeForSection($query, Section $section)
    {
        $sections_id = [$section->id];

        return $query->whereIn('section_id', $sections_id);
    }

}
