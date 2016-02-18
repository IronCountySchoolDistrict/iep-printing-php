<?php

namespace App\Iep;

use Yajra\Oci8\Eloquent\OracleEloquent as Model;

class StudentCoreField extends Model {
  protected $table = 'STUDENTCOREFIELDS';
  protected $primaryKey = 'STUDENTSDCID';

  public function student() {
    return $this->belongsTo('App\Iep\Student', 'studentsdcid', 'dcid');
  }
}
