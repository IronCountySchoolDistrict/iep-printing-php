<?php

namespace App\Iep;

use Yajra\Oci8\Eloquent\OracleEloquent as Model;

class School extends Model {
  protected $table = 'SCHOOLS';
  protected $primaryKey = 'DCID';

  public function student() {
    return $this->belongsTo('App\Iep\Student', 'schoolid', 'school_number');
  }
}
