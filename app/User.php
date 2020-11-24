<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    protected $fillable = [
        'name', 'email', 'password', 'college_id', 'cell_phone', 'phone', 'position', 'status'
    ];
    public $timestamps = true;

    protected $hidden = ['password', 'remember_token',];

    public function college()
    {
        return $this->belongsTo('App\College');
    }

    public function assigments()
    {
        return $this->belongsToMany('App\Assignment');
    }

    public function scopeSearch($query, $search)
    {
        if(trim($search!="")) {
            $query->where('name', 'LIKE', "%$search%");
            $query->orWhere('email', 'LIKE', "%$search%");
        }
    }
    public function getStatusNameAttribute()
    {
        return ($this->status)?'Activo':'Inactivo';
    }
}
