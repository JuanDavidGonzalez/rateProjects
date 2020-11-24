<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model 
{

    protected $table = 'participants';
    public $timestamps = true;
    protected $fillable = array('name', 'type', 'participantable_id', 'participantable_type', 'document_type', 'document_num', 'email', 'phone');

    public function participantable()
    {
        return $this->morphTo();
    }

    public function getTypeAttribute()
    {
        $type = $this->attributes['type'];
        if($type =="groupMember")
            return "Participante";
        elseif ($type =="leader")
            return "Lider";
        elseif ($type=="tutor")
            return "Tutor";
        elseif ($type=="director")
            return "Director";
        elseif ($type=="speaker")
            return "Ponente";
        elseif ($type=="assistant")
            return "Asistente";

    }

}