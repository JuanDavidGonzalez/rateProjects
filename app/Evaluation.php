<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model 
{

    protected $table = 'evaluations';
    public $timestamps = true;
    protected $fillable = array('score', 'criterion_id', 'project_id', 'user_id');

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function criterion()
    {
        return $this->belongsToMany('App\Criterion')->withPivot('score', 'observation');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getTotalScoreAttribute()
    {
        $score = 0;
        foreach ($this->criterion as $criteria){
            $score += ($criteria->pivot->score * ($criteria->weighing)/100);
        }
        return round($score,1);
    }

    public function getStatusattribute()
    {
        if($this->criterion->count())
            return 1;
        return 0;
    }

}