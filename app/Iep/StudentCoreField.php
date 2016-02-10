<?php

namespace App\Iep;

use Illuminate\Database\Eloquent\Model;

class StudentCoreField extends Model {
  protected $table = 'STUDENTCOREFIELDS';
  protected $primaryKey = 'STUDENTSDCID';

  public function student() {
    return $this->belongsTo('App\Iep\Student', 'studentsdcid', 'dcid');
  }
}
