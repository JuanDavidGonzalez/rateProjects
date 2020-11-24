<?php
/**
 * Created by PhpStorm.
 * User: Juan David
 * Date: 17/12/2018
 * Time: 6:10 PM
 */

namespace App;


use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $fillable = ['name', 'display_name', 'description', 'created_at', 'updated_at'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}