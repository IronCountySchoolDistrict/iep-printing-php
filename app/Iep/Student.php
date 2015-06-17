<?php namespace App\Iep;

use Carbon\Carbon;

class Student {
	private $lastFirst;
	private $firstName;
	private $middleName;
	private $lastName;
	private $studentNumber;
	private $grade;
	private $entryDate;
	private $exitDate;
	private $gender;
	private $currentSchool;
	private $dob;
	private $street;
	private $city;
	private $state;
	private $zip;
	private $nextSchool;
	private $enrollmentSchool;
	private $father;
	private $mother;

	/**
	* create new student from json string or json decoded string (stdClass)
	*
	* @param mixed $data
	*/
	public function __construct($data)
	{
		if (is_string($data)) {
			$data = json_decode($data);
		}

		$this->lastFirst = isset($data->lastfirst) ? $data->lastfirst : '';
		$this->firstName = isset($data->first_name) ? $data->first_name : '';
		$this->middleName = isset($data->middle_name) ? $data->middle_name : '';
		$this->lastName = isset($data->last_name) ? $data->last_name : '';
		$this->studentNumber = isset($data->student_number) ? $data->student_number : 0;
		$this->grade = (isset($data->grade)) ? $data->grade : 0;
		$this->entryDate = isset($data->entrydate) ? new Carbon($data->entrydate) : null;
		$this->exitDate = isset($data->exitdate) ? new Carbon($data->exitdate) : null;
		$this->gender = isset($data->gender) ? $data->gender : '';
		$this->currentSchool = isset($data->current_school) ? $data->current_school : '';
		$this->dob = isset($data->dob) ? new Carbon($data->dob) : null;
		$this->street = isset($data->street) ? $data->street : '';
		$this->city = isset($data->city) ? $data->city : '';
		$this->state = isset($data->state) ? $data->state : '';
		$this->zip = isset($data->zip) ? $data->zip : '';
		$this->nextSchool = isset($data->next_school) ? $data->next_school : '';
		$this->enrollmentSchool = isset($data->enrollment_school) ? $data->enrollment_school : '';
		$this->father = isset($data->father) ? $data->father : '';
		$this->mother = isset($data->mother) ? $data->mother : '';
	}

	/**
	* get first name and last name combined
	* @return string
	*/
	public function getFirstLast() {
		return $this->firstName . ' ' . $this->lastName;
	}

	/**
	* get the full name First Middle(if !empty) Last
	* @return string
	*/
	public function getFullName() {
		$name = $this->firstName;

		if (!empty($this->middleName)) {
			$name .= ' ' . $this->middleName;
		}

		$name .= ' ' . $this->lastName;

		return $name;
	}

	/**
	* get the lastname, firstname middleaname
	* @return string
	*/
	public function getLastFirst() {
		return $this->lastFirst;
	}

	/**
	* get the first name
	* @return string
	*/
	public function getFirstName() {
		return $this->firstName;
	}

	/**
	* get the middle name
	* @return string
	*/
	public function getMiddleName() {
		return $this->middleName;
	}

	/**
	* get the last name
	* @return string
	*/
	public function getLastName() {
		return $this->getLastName();
	}

	/**
	* get the student number
	* @return integer
	*/
	public function getStudentNumber() {
		return $this->studentNumber;
	}

	public function getGrade() {
		return $this->grade;
	}

	/**
	* get the entry date
	* @return Carbon\Carbon
	*/
	public function getEntryDate() {
		return $this->entryDate;
	}

	/**
	* simplified getter for the entry date
	* @return Carbon\Carbon
	*/
	public function entryDate() {
		return $this->entryDate;
	}

	/**
	* get the exit date
	* @return Carbon\Carbon
	*/
	public function getExitDate() {
		return $this->exitDate;
	}

	/**
	* simplified getter for the exit date
	* @return Carbon\Carbon
	*/
	public function exitDate() {
		return $this->exitDate;
	}

	/**
	* get the gender 'M' or 'F'
	* @return string
	*/
	public function getGender() {
		return $this->gender;
	}

	/**
	* get the current school
	* @return string
	*/
	public function getCurrentSchool() {
		return $this->currentSchool;
	}

	/**
	* get the date of birth
	* @return Carbon\Carbon
	*/
	public function getDob() {
		return $this->dob;
	}

	/**
	* simplified getter for the DOB
	* @return Carbon\Carbon
	*/
	public function dob() {
		return $this->dob;
	}

	/**
	* get the street address
	* @return string
	*/
	public function getStreet() {
		return $this->street;
	}

	/**
	* get the city
	* @return string
	*/
	public function getCity() {
		return $this->city;
	}

	/**
	* get the zipcode
	* @return string
	*/
	public function getZip() {
		return $this->zip;
	}

	/**
	* alternate getter for the zipcode
	* @return string
	*/
	public function getZipcode() {
		return $this->zip;
	}

	/**
	* get the state e.g. Utah
	* @return string
	*/
	public function getState() {
		return $this->state;
	}

	/**
	* get the full address in one line
	* @return string
	*/
	public function getAddress() {
		return $this->street . ' '
			. $this->city . ', '
			. $this->state . ' '
			. $this->zip;
	}

	/**
	* get the next school
	* @return string
	*/
	public function getNextSchool() {
		return $this->nextSchool;
	}

	/**
	* get the school of enrollment
	* @return string
	*/
	public function getEnrollmentSchool() {
		return $this->enrollmentSchool;
	}

	/**
	* get the name of the mother
	* @return string
	*/
	public function getMother() {
		return $this->mother;
	}

	/**
	* get the name of the father
	* @return string
	*/
	public function getFather() {
		return $this->father;
	}

	/**
	* get one of the parents, father is prioritized
	* @return string
	*/
	public function getParent() {
		if (!empty($this->father)) return $this->father;

		return $this->mother;
	}

	/**
	* gets all the properties of the class and supplements it
	* with extras that have functions associated with them
	* @return array
	*/
	public function getProperties() {
		$exist = array_keys(get_object_vars($this));
		$supplement = [
			'student',
			'name',
		];

		return array_merge($exist, $supplement);
	}

	public function getStudent() {
		return $this->getLastFirst();
	}

	public function getName() {
		return $this->getLastFirst();
	}

	/**
	* set the lastname, firstname middlename
	* @param $name
	*/
	public function setLastFirst($name) {
		if (is_string($name)) {
			if (strpos($name, ',')) {
				$this->lastFirst = $name;
			}
		}
	}

	/**
	* set the first name
	* @param $name
	*/
	public function setFirstName($name) {
		if (is_string($name)) {
			$this->firstName = $name;
		}
	}

	/**
	* set the middle name
	* @param $name
	*/
	public function setMiddleName($name) {
		if (is_string($name)) {
			$this->middleName = $name;
		}
	}

	/**
	* set the last name
	* @param $name
	*/
	public function setLastName($name) {
		if (is_string($name)) {
			$this->lastName = $name;
		}
	}

	/**
	* set the student number
	* @param $number
	*/
	public function setStudentNumber($number) {
		if (is_int($number)) {
			$this->studentNumber = $number;
		}
	}

	public function setGrade($grade) {
		if (is_int($grade)) {
			$this->grade = $grade;
		}
	}

	/**
	* set the entry date
	* @param mixed $date
	*/
	public function setEntryDate($date) {
		$this->entryDate = $this->setDate($this->entryDate, $date);
	}

	/**
	* set the exit date
	* @param mixed $date
	*/
	public function setExitDate($date) {
		$this->exitDate = $this->setDate($this->exitDate, $date);
	}

	/**
	* set the gender
	* @param string $gender
	*/
	public function setGender($gender) {
		if (is_string($gender)) {
			if ($gender === 'F' || $gender === 'M') {
				$this->gender = $gender;
			}
		}
	}

	/**
	* set the current school
	* @param string $school
	*/
	public function setCurrentSchool($school) {
		if (is_string($school)) {
			$this->currentSchool = $school;
		}
	}

	/**
	* set the date of birth
	* @param mixed $date
	*/
	public function setDob($date) {
		$this->dob = $this->setDate($this->dob, $date);
	}

	/**
	* set the street address
	* @param string $street
	*/
	public function setStreet($street) {
		if (is_string($street)) {
			$his->street = $street;
		}
	}

	/**
	* set the city
	* @param string $city
	*/
	public function setCity($city) {
		if (is_string($city)) {
			$ths->city = $city;
		}
	}

	/**
	* set the state
	* @param string $state
	*/
	public function setState($state) {
		if (is_string($state)) {
			$this->state = $state;
		}
	}

	/**
	* set the zipcode
	* @param mixed $zip
	*/
	public function setZip($zip) {
		if (is_string($zip)) {
			$this->zip = $zip;
		} else if (is_int($zip)) {
			$this->zip = "$zip";
		}
	}

	/**
	* alternate setter for the zipcode
	* @param mixed $zip
	*/
	public function setZipcode($zip) {
		$this->setZip($zip);
	}

	/**
	* set the next school
	* @param string $school
	*/
	public function setNextSchool($school) {
		if (is_string($school)) {
			$this->nextSchool = $school;
		}
	}

	/**
	* set the school of enrollment
	* @param string $school
	*/
	public function setEnrollmentSchool($school) {
		if (is_string($school)) {
			$this->enrollmentSchool = $school;
		}
	}

	/**
	* set the name of the father of the student
	* @param string $father
	*/
	public function setFather($father) {
		if (is_string($father)) {
			$this->father = $father;
		}
	}

	/**
	* set the name of the mother of the student
	* @param string $mother
	*/
	public function setMother($mother) {
		if (is_string($mother)) {
			$this->mother = $mother;
		}
	}

	/**
	* sets the date to the property if the date is valid
	* @param Carbon\Carbon $propertyValue
	* @param mixed $date
	* @return Carbon\Carbon
	*/
	protected function setDate($propertyValue, $date) {
		if ($date instanceof Carbon) {
			$propertyValue = $date;
		} else if ($date instanceof DateTime) {
			$propertyValue = new Carbon($date);
		} else if (is_string($date)) {
			try {
				$date = new Carbon($date);
				$propertyValue = $date;
			} catch (Exception $e) {
				// invalid date string -- do nothing
			}
		}

		return $propertyValue;
	}
}
