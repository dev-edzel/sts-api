<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasApiTokens, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
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

    public function user_info(): HasOne
    {
        return $this->hasOne(UserInfo::class);
    }

    public function role(): HasOneThrough
    {
        return $this->hasOneThrough(
            Role::class,
            RoleUser::class,
            'user_id',
            'id',
            'id',
            'role_id'
        );
    }

    public function hasPermission($permission)
    {
        foreach ($this->roles as $role) {
            if ($role->permissions->contains('name', $permission)) {
                return true;
            }
        }
        return false;
    }

    public function isSuperAdmin()
    {
        return $this->role?->name === 'super-admin';
    }

    public function isAdmin()
    {
        return $this->role?->name === 'admin';
    }

    public function isSuperUser()
    {
        return $this->role?->name === "super-admin" || $this->role?->name === "admin";
    }

    public function permitted($permissions = [], $any = false)
    {
        $permissions = array_unique($permissions);
        $rolePermissions = $this->role ? $this->role->permissions->pluck('name')->toArray() : [];

        $inArray = array_sum(
            array_map(function ($permission) use ($rolePermissions) {
                return in_array($permission, $rolePermissions) ? 1 : 0;
            }, $permissions)
        );

        if (!$any) {
            return count($permissions) == $inArray;
        } else {
            return $inArray > 0;
        }
    }

    public function toSearchableArray()
    {
        return [
            'username' => $this->username,
            'email' => $this->email,
        ];
    }
}
