<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seedbed extends Model 
{

    protected $table = 'seedbeds';
    public $timestamps = true;
    protected $fillable = array('name', 'initials', 'line', 'status', 'group_id');

    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    public function participants()
    {
        return $this->morphMany('App\Participant', 'participantable');
    }

    public function getStatusNameAttribute()
    {
        return ($this->status)?'Activo':'Inactivo';
    }

    public function scopeSearch($query, $search)
    {
        if(trim($search!="")) {
            $query->where('name', 'LIKE', "%$search%");
            $query->orWhere('initials', 'LIKE', "%$search%");
        }
    }
}