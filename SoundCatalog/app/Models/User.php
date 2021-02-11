<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }


    /**
     * Returns true, if the user has the given role.
     * @param string $role
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        $rolesCount = $this->roles
            ->where('name', '=', $role)
            ->count();

        return $rolesCount !== 0;
    }

    /**
     * Returns true, if user or his role has the given permission.
     * @param string $permission
     * @return bool
     */
    private function hasUserPermission(string $permission): bool
    {
        $permissionsCount = $this->permissions
            ->where('name', '=', $permission)
            ->count();

        return $permissionsCount !== 0;
    }


    /**
     * Returns true, if at least one user role has a given permission.
     * @param string $permissionName
     * @return bool
     */
    private function hasUserRolePermission(string $permissionName): bool
    {
        $permissions = Permission::where('name', '=', $permissionName)->count();

        if ($permissions === 0) return false;


        foreach ($permission->roles as $role) {
            if ($this->roles->contains($role)) {
                return true;
            }
        }

        return false;
    }


    /**
     * Returns true, if user has the given permission.
     * @param string $permission
     * @return bool
     */
    public function hasPermission(string $permission): bool
    {
        return $this->hasUserPermission($permission) || $this->hasUserRolePermission($permission);
    }

    /**
     * Returns true, if user has all given permissions.
     * @param string[] $permissions
     * @return bool
     */
    public function hasPermissions(array $permissions): bool
    {
        foreach ($permissions as $permission) {
            if (!$this->hasPermission($permission)) {
                return false;
            }
        }

        return true;
    }
}
