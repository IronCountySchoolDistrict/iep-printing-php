<?php

namespace App\Iep;

use Yajra\Oci8\Eloquent\OracleEloquent as Model;

class User extends Model {
  protected $table = 'USERS';
  protected $primaryKey = 'DCID';
}
