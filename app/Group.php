<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model 
{

    protected $table = 'groups';
    public $timestamps = true;
    protected $fillable = array('name', 'initials', 'interest_area', 'colciencias', 'status', 'college_id');

    public function seedbeds()
    {
        return $this->hasMany('App\Seedbed');
    }

    public function participant()
    {
        return $this->morphOne('App\Participant', 'participantable');
    }

    public function college()
    {
        return $this->belongsTo('App\College');
    }

    public function getStatusNameAttribute()
    {
        return ($this->status)?'Activo':'Inactivo';
    }

    public function getColcienciasNameAttribute()
    {
        return ($this->colciencias)?'Si':'No';
    }

    public function scopeSearch($query, $search)
    {
        if(trim($search!="")) {
            $query->where('name', 'LIKE', "%$search%");
            $query->orWhere('initials', 'LIKE', "%$search%");
        }
    }

}