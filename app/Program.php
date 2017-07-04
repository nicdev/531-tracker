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

  private static function estimateBaseWeight($oneRepMax) {
    return ceil((.9 * $oneRepMax) / 5) * 5;
  }

}
