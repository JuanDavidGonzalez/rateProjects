<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Criterion extends Model
{

    protected $table = 'criteria';
    public $timestamps = true;
    protected $fillable = array('name', 'description', 'weighing');

    public function evaluations()
    {
        return $this->belongsToMany('App\Evaluation');
    }

}