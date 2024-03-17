<?php

namespace App\Services\MediaLibrary;

use App\Models\Post;
use App\Models\User;
use \Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator as BasePathGenerator;

class CustomPathGenerator implements BasePathGenerator
{
    public function getPath(Media $media): string
    {
        switch ($media->model_type) {
            case Post::class:
                return Post::PATH.DIRECTORY_SEPARATOR.$media->id.DIRECTORY_SEPARATOR;
                break;
            case User::class:
                return User::PATH.DIRECTORY_SEPARATOR.$media->id.DIRECTORY_SEPARATOR;
                break;
            default:
                return $media->id.DIRECTORY_SEPARATOR;
        }
    }
    public function getPathForConversions(Media $media): string
    {
        return $this->getPath($media).'thumbnails/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media).'rs-images/';
    }
}
