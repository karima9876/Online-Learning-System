<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $fillable = [
        'student_id','username', 'email', 'password','name','department','ses','iname', 'fname','mname','address','birth_date','cnumber','guarcontact','blood_group','photo',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ]; 

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getpermissionGroups()
    {
       
        $permission_groups=DB::table('permissions')
        ->select('group_name as name')
        ->groupBy('group_name')
        ->get();

        

        return $permission_groups;
    }


    public static function getPermissionsByGroupName($group_name)
    {
        $permissions = DB::table('permissions')
            ->select('id', 'name')
            ->where('guard_name', 'web')
            ->where('group_name', $group_name)
            ->get();
        return $permissions;
    }
    public static function roleHasPermissions($role,$permissions)
    {
        $hasPermission=true;
        foreach ($permissions as $permission){
            if(!$role->hasPermissionTo($permission->name)){
                $hasPermission=false;
                return $hasPermission;
            }
        }
        return $hasPermission;

    }
}
