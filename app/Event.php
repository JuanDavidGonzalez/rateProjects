<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model 
{

    protected $table = 'events';
    public $timestamps = true;
    protected $fillable = array('start_date', 'end_date', 'name', 'headquarters', 'city', 'status');

    public function scopeSearch($query, $search)
    {
        if(trim($search!="")) {
            $query->where('name', 'LIKE', "%$search%");
        }
    }
    public function getStatusNameAttribute()
    {
        return ($this->status)?'Activo':'Inactivo';
    }

}