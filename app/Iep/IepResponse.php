<?php

namespace App\Iep;

use DB;
use Carbon\Carbon;
use Yajra\Oci8\Eloquent\OracleEloquent as Model;

class IepResponse extends Model {
  protected $table = 'U_SPED_IEP_RESPONSE';
  protected $dates = ['whencreated', 'whenmodified'];
  public $timestamps = false;

  public function iep() {
    return $this->belongsTo('App\Iep\Iep', 'id', 'u_sped_iepid', 'id');
  }

  public function save(array $options = []) {
    if (empty($this->id)) {
      $this->id = self::max('id') + 1;
    }

    parent::save($options);
  }
}
