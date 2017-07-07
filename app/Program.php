<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{

  protected $fillable = [
    'one_rep_max_deadlift',
    'one_rep_max_press',
    'one_rep_max_squat',
    'one_rep_max_bench'
  ];

  public function setOneRepMaxDeadliftAttribute($value)
  {
    $this->attributes['one_rep_max_deadlift'] = (int) $value;
  }

  public function setOneRepMaxPressAttribute($value)
  {
    $this->attributes['one_rep_max_press'] = (int) $value;
  }

  public function setOneRepMaxSquatAttribute($value)
  {
    $this->attributes['one_rep_max_squat'] = (int) $value;
  }

  public function setOneRepMaxBenchAttribute($value)
  {
    $this->attributes['one_rep_max_bench'] = (int) $value;
  }

  public function getBaseAttribute() {
    return [
      'deadlift' => $this->estimateBaseWeight($this->one_rep_max_deadlift),
      'press' => $this->estimateBaseWeight($this->one_rep_max_press),
      'squat' => $this->estimateBaseWeight($this->one_rep_max_squat),
      'bench' => $this->estimateBaseWeight($this->one_rep_max_bench)
    ];
  }

  public function getWeek($week) {
    $result = [];
    
    foreach($this->base as $movement => $baseWeight) {
      for($i = 1; $i <= 3; $i++) {
          $result[$movement]["set{$i}"] = [
            'weight'=> $this->roundWeight($baseWeight, config("percents.{$week}.set{$i}")),
            'reps' => config("reps.{$week}.set{$i}")
          ];
      }
    }

    return $result;
  }

  private static function estimateBaseWeight($oneRepMax) {
    return ceil((config('percents.base') * $oneRepMax) / 5) * 5;
  }

  private static function roundWeight($baseWeight, $percentage) {
    return ceil(($baseWeight * $percentage) / 5) * 5;
  }
}
