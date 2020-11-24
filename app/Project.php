<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model 
{

    protected $table = 'projects';
    public $timestamps = true;
    protected $fillable = array('name', 'status', 'from', 'projectable_type', 'projectable_id', 'file',
                                'educational_level', 'event_id', 'thematic', 'enable');

    public function projectable()
    {
        return $this->morphTo();
    }

    public function evaluations()
    {
        return $this->hasMany('App\Evaluation');
    }

    public function assigment()
    {
        return $this->hasOne('App\Assignment');
    }

    public function participants()
    {
        return $this->morphMany('App\Participant', 'participantable');
    }

    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    public function getStatusNameAttribute()
    {
        $type = $this->attributes['status'];
        if($type =="inprogress")
            return "En Curso";
        elseif ($type =="proposal")
            return "Propuesta";
        elseif ($type=="finished")
            return "Finalizado";
    }

    public function getFromAttribute()
    {
        $type = $this->attributes['from'];
        if($type =="seedbed")
            return "Semillero";
        elseif ($type =="group")
            return "Grupo";
    }

    public function scopeSearch($query, $search)
    {
        if(trim($search!="")) {
            if($search =="En Curso")
                $search="inprogress";
            elseif ($search =="Propuesta")
                $search="proposal";
            elseif ($search=="Finalizado")
                $search="finished";

            $query->where('name', 'LIKE', "%$search%");
            $query->orWhere('status', 'LIKE', "%$search%");
        }
    }

}