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
    protected $appends = ['feature_image'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')
            ->whereNull('parent_id');
    }
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
    public function setTitleAttribute($value)
    {
        $this->attributes['title']  = $value;
        $this->attributes['slug']   = str_slug($value);
    }
    public function clearMediaCollection(string $collectionName = 'default'):HasMedia
    {

    }
    public function getFeatureImageAttribute()
    {
        $hasMedia = $this->getMedia('feature_image')->first();
        return $hasMedia != null ? $hasMedia->getUrl() : "";
    }

}
