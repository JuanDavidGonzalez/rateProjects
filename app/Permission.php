<?php
/**
 * Created by PhpStorm.
 * User: Juan David
 * Date: 17/12/2018
 * Time: 6:12 PM
 */

namespace App;


use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $fillable = ['name', 'display_name', 'description', 'created_at', 'updated_at'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}