<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'designer_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isDesigner()
    {
        return $this->role === 'desainer';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    public function getRoleBadgeAttribute()
    {
        return match($this->role) {
            'admin' => '<span class="badge bg-danger">Admin</span>',
            'desainer' => '<span class="badge bg-primary">Desainer</span>',
            'user' => '<span class="badge bg-success">User</span>',
            default => '<span class="badge bg-secondary">Unknown</span>'
        };
    }
}
