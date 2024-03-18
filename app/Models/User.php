<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, InteractsWithMedia;

    const PATH = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'slug'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    protected $appends = ['role_id', 'avatar'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    public function getRoleIdAttribute()
    {
        if ($this->roles->isNotEmpty()) {
            return $this->roles[0]->id;
        }

        return null;
    }
    public function getAvatarAttribute()
    {
       return $this->getMedia('user_avatar')->first()->getUrl();
    }

    public function clearMediaCollection(string $collectionName = 'default'):HasMedia
    {

    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function isModerator(array $permissions = []):bool
    {
        return $this->hasAnyRole(['admin', 'editor']) &&
            $this->hasAnyPermission($permissions);

    }
}
