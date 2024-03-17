<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements hasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    const PATH = 'posts';
    protected $fillable = [
        'title',
        'content',
        'status',
        'excerpt',
        'user_id',
        'category_id'
    ];
    protected $appends = ['url', 'feature_image'];
    public function setTitleAttribute($value)
    {
        $this->attributes['title']  = $value;
        $this->attributes['slug']   = str_slug($value);
    }
    public function clearMediaCollection(string $collectionName = 'default'):HasMedia
    {

    }
    public function getUrlAttribute()
    {
        $hasMedia = $this->getMedia('feature_image')->first();
        return  $hasMedia != null ?
            $hasMedia->getUrl() : "";
    }

}
