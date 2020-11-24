<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignmentUser extends Model 
{

    protected $table = 'assignment_user';
    public $timestamps = true;
    protected $fillable = array('user_id', 'assignment_id');

}