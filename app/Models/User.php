<?php

namespace App\Models;

use Carbon\Carbon;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
    use HasMediaTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'phone', 'birth',
        'city', 'postcode', 'street_address',
        'role', 'is_active',
    ];


    public function getRouteKeyName()
    {
        return 'name';
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

    public function isAdmin()
    {
        return in_array($this->role, ['admin', 'superadmin']);
    }

    public function isBasicAdmin()
    {
        return $this->role == 'admin';
    }

    public function isSuperAdmin()
    {
        return $this->role == 'superadmin';
    }

    public function canManage(Section $section)
    {
        if ($this->isSuperAdmin()) {
            return true;
        } elseif ($this->isBasicAdmin()) {
            $managed_sections_ids =
            $this->managed_sections()->get()->pluck('id')->toArray();
            //dd($managed_sections_ids);
            return in_array($section->id, $managed_sections_ids);
        }

        return false;
    }

    public function managed_sections_list()
    {
        if (! $this->isAdmin()) {
            return [];
        }
        if ($this->isSuperAdmin()) {
            return Section::pluck('title', 'id');
        }

        return $this->managed_sections->pluck('title', 'id');
    }

    public function managed_sections()
    {
        return $this->belongsToMany(Section::class, 'admin_sections', 'user_id', 'section_id')->withPivot('created_at');
    }

    public function setBirthAttribute($birth = null)
    {
        $this->attributes['birth'] = $birth
        ? Carbon::createFromFormat('d/m/Y', $birth)->format('Y-m-d')
        : null;
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
