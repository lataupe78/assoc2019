<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $guarded = [];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function scopePublished($query)
    {
        return $query
        ->where([
            'is_published' => true,
        ]);
    }

    public function scopeForSection($query, Section $section)
    {
        $sections_id = [$section->id];

        return $query->whereIn('section_id', $sections_id);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    /*
    public function getCoverPictureAttribute(){
        $url = $this->image ?: "images/posts/default.png";
        return Storage::url($url, 'public');
    }
    */
}
