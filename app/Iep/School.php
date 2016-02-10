<?php

namespace App\Iep;

use Illuminate\Database\Eloquent\Model;

class School extends Model {
  protected $table = 'SCHOOLS';
  protected $primaryKey = 'DCID';

  public function student() {
    return $this->belongsTo('App\Iep\Student', 'schoolid', 'school_number');
  }
}
