<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function admins()
    {
        return $this->belongsToMany(User::class, 'admin_sections');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function recent_posts()
    {
        return $this->posts()->orderBy('published_at', 'desc')->limit(3);
    }

    public function scopeParent($query)
    {
        return $query
        ->where([
            'parent_id' => null,
        ]);
    }

    public function scopeActive($query)
    {
        return $query
        ->where([
            'is_active' => true,
        ]);
    }

    public function scopeForSlug($query, $section_slug = '', $subsection_slug = '')
    {
        $slug = ($subsection_slug)
        ? $section_slug.'/'.$subsection_slug
        : $section_slug;

        return $query
        ->where([
            'slug' => $slug,
        ]);
    }
}
