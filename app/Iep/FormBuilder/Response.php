<?php

namespace App\Iep\FormBuilder;

use Yajra\Oci8\Eloquent\OracleEloquent as Model;

class Response extends Model {
  protected $table = 'U_FB_FORM_RESPONSE';
  protected $dates = ['created_on', 'modified_on', 'whencreated', 'whenmodified'];
  public $timestamps = false;

  public function form() {
    return $this->belongsTo('App\Iep\FormBuilder\Form', 'u_fb_form_id');
  }

  public function student() {
    return $this->belongsTo('App\Iep\Student', 'student_id');
  }
}
