<?php

namespace App\Models;

use App\Traits\Admin;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
    use HasMediaTrait;
    use Notifiable;
    use HasSlug;
    use Admin;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'email', 'password',
        'phone', 'birth',
        'city', 'postcode', 'street_address',
        'role', 'is_active',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
        ->generateSlugsFrom('name')
        ->saveSlugsTo('slug');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'email_verified_at',
        'birth',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth' => 'datetime:Y-m-d',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }


    public function setBirthAttribute($birth = null)
    {
        $this->attributes['birth'] = $birth
        ? Carbon::createFromFormat('d/m/Y', $birth)->format('Y-m-d')
        : null;
    }

    public function getBirthAttribute($birth = null)
    {
        return ($birth != null)
        ? Carbon::createFromFormat('Y-m-d', $birth)->format('d/m/Y')
        : null;
    }


    // 'attachments' media collection
    public function avatar()
    {
        return $this->media()->where('collection_name', 'avatar');
    }


    public function registerMediaCollections()
    {
        $this
        ->addMediaCollection('avatar')
        ->singleFile();
    }

    public function registerMediaConversions(Media $media = null)
    {
        //$conversion =
        $this->addMediaConversion('thumb')
        ->fit(Manipulations::FIT_CROP, 256, 256)
        ->width(256)
        ->height(256);

        //$conversion =
        $this->addMediaConversion('thumb-xs')
        ->fit(Manipulations::FIT_CROP, 64, 64)
        ->width(64)
        ->height(64);
    }

    public function getAvatarPictureAttribute()
    {
        return $this->getFirstMediaUrl('avatar', 'thumb')
        ?: 'storage/images/avatars/default-avatar.png';
    }

    public function getAvatarThumbAttribute()
    {
        return $this->getFirstMediaUrl('avatar', 'thumb-xs')
        ?: 'storage/images/avatars/default-avatar.png';
    }
}
