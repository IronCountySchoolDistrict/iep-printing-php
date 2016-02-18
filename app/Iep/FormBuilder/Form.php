<?php

namespace App\Iep\FormBuilder;

use Yajra\Oci8\Eloquent\OracleEloquent as Model;

class Form extends Model {
  protected $table = 'U_FB_FORM';
  protected $dates = ['created_on', 'modified_on', 'whencreated', 'whenmodified'];
  public $timestamps = false;

  public function responses() {
    return $this->hasMany('App\Iep\FormBuilder\Response', 'u_fb_form_id');
  }
}
