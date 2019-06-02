<?php

namespace App\Models;
use Spatie\MediaLibrary\Models\Media as BaseMedia;
/**
cf:
https://github.com/spatie/laravel-medialibrary/issues/1360
https://docs.spatie.be/laravel-medialibrary/v7/advanced-usage/using-your-own-model
*/

class Media extends BaseMedia
{

	protected $appends = ['url'];


    public function getUrlAttribute()
    {
        return $this->getUrl();
    }

}
