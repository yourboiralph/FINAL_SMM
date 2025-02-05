<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'role_id',
        'phone',
        'image',
        'address',
        'email',
        'password',
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
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    // Job Orders Relationships (User Can Have Multiple Roles)
    public function jobOrdersAsContentWriter()
    {
        return $this->hasMany(JobOrder::class, 'content_writer_id');
    }

    public function jobOrdersAsGraphicDesigner()
    {
        return $this->hasMany(JobOrder::class, 'graphic_designer_id');
    }

    public function jobOrdersAsClient()
    {
        return $this->hasMany(JobOrder::class, 'client_id');
    }

    public function jobOrdersIssued()
    {
        return $this->hasMany(JobOrder::class, 'issued_by');
    }
}
