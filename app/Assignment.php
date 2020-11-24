<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model 
{

    protected $table = 'assignments';
    public $timestamps = true;
    protected $fillable = array('classroom', 'day', 'hour', 'project_id');

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function getDayEsAttribute()
    {
        $type = $this->attributes['day'];
        if($type =="wednesday")
            return "Miércoles";
        elseif ($type =="thursday")
            return "Jueves";
    }

}