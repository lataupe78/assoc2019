<?php

namespace App\Media;

use App\Models\User as User;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\PathGenerator\PathGenerator;

class CustomPathGenerator implements PathGenerator
{
    public function getPath(Media $media) : string
    {
        /*
        dump(get_class($media));
        dump($media instanceof User);
        dump($media instanceof App\Models\User);
        dump($media->model_type === 'App\Models\User');
        dd($media);
        */
        /*
        if ($media instanceof Post) {
            return 'posts/' . $media->id;
        }

        if ($media instanceof Product) {
            return 'products/' . $media->id;
        }
        */
        if ($media->model_type === 'App\Models\User') {
            return 'images/avatars/'.$media->id.'/';
        }

        return 'images/'.$media->id.'/';
    }

    public function getPathForConversions(Media $media) : string
    {
        return $this->getPath($media).'conversions/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media).'responsive/';
    }
}
