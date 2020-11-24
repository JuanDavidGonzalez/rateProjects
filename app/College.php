<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class College extends Model 
{

    protected $table = 'colleges';
    public $timestamps = true;
    protected $fillable = array('name', 'initials', 'city');

    public function scopeSearch($query, $search)
    {
        if(trim($search!="")) {
            $query->where('name', 'LIKE', "%$search%");
        }
    }
}