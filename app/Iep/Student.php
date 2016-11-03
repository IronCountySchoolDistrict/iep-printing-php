<?php

namespace App\Iep;

use Carbon\Carbon;
use Yajra\Oci8\Eloquent\OracleEloquent as Model;

class Student extends Model {
  protected $table = 'STUDENTS';
  protected $primaryKey = 'DCID';
  protected $dates = ['dob'];
  protected $hidden = array('custom', 'enrollment_transfer_info');

  public function school() {
    return $this->hasOne('App\Iep\School', 'school_number', 'schoolid');
  }

  public function studentCoreField() {
    return $this->hasOne('App\Iep\StudentCoreField', 'studentsdcid', 'dcid');
  }

  public function fb_responses() {
    return $this->hasMany('App\Iep\FormBuilder\Response', 'student_id', 'id');
  }

  public function getLastFirst() {
    return $this->lastfirst;
  }

  public function getSchoolCity() {
    return $this->school->schoolcity;
  }

  public function getSchoolName() {
    return $this->school->name;
  }

  public function getStudentNumber() {
    return $this->student_number;
  }

  public function getParentWorkPhone() {
    $coreField = $this->studentCoreField;
    if (!empty($coreField->guardiandayphone)) return $coreField->guardiandayphone;
    if (!empty($coreField->motherdayphone)) return $coreField->motherdayphone;

    return $coreField->fatherdayphone;
  }

  public function getParent() {
    if (!empty($this->mother)) return $this->mother;

    return $this->father;
  }

  public function getParents() {
    $parents = '';
    if (!empty($this->father)) $parents .= $this->father;

    if (!empty($this->mother)) $parents .= " and $this->mother";

    if (starts_with($parents, ' and ')) $parents = substr($parents, 5);

    return $parents;
  }

  public function getYears() {
    return $this->dob->diffInYears(new Carbon());
  }

  public function getMonths() {
    return $this->dob->addYears($this->getYears())->diffInMonths(new Carbon());
  }

  public function getDob() {
    return $this->dob;
  }

  public function getGrade() {
    if ($this->grade_level == 0) {
      return 'K';
    } else if ($this->grade_level == -1) {
      return 'PK4';
    } else if ($this->grade_level == -2) {
      return 'PK3';
    } else {
      return $this->grade_level;
    }
  }

  public function getAddress() {
    return $this->street . ' ' . $this->city . ', ' . $this->state . ' ' . $this->zip;
  }
}
