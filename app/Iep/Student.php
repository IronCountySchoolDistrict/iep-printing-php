<?php

namespace App\Iep;

use Carbon\Carbon;

class Student {

	/**
	 * create a new student with json data
	 *
	 * @param mixed $data json_string or stdClass
	 */
	public function __construct($data) {
		if (is_string($data)) {
			$data = json_decode($data);
		}

		foreach ($data as $key => $value) {
			$propName = camel_case($key);
			$propVal = $value;

			if (strpos($key, 'date') !== false || $key == 'dob') {
				try {
					$propVal = new Carbon($value);	
				} catch (Exception $e) {}
			}

			$this->{$propName} = $propVal;
		}
	}

	/**
	 * general getter for property values
	 *
	 * @param string $property
	 */
	public function get($property) {
		if (property_exists($this, $property)) {
			return $this->{$property};
		}

		return;
	}

	/**
	 * get first name and last name combined
	 *
	 * @return string
	 */
	public function getFirstLast()
	{
		return $this->firstName . ' ' . $this->lastName;
	}

	/**
	 * get the full name First Middle(if !empty) Last
	 *
	 * @return string
	 */
	public function getFullName()
	{
		$name = $this->firstName;

		if (!empty($this->middleName)) {
			$name .= ' ' . $this->middleName;
		}

		$name .= ' ' . $this->lastName;

		return $name;
	}

	/**
	 * get the lastname, firstname middleaname
	 *
	 * @return string
	 */
	public function getLastFirst()
	{
		return $this->lastfirst;
	}

	/**
	 * get the first name
	 *
	 * @return string
	 */
	public function getFirstName()
	{
		return $this->firstName;
	}

	/**
	 * get the middle name
	 *
	 * @return string
	 */
	public function getMiddleName()
	{
		return $this->middleName;
	}

	/**
	 * get the last name
	 *
	 * @return string
	 */
	public function getLastName()
	{
		return $this->lastName;
	}

	/**
	 * get the student number
	 *
	 * @return integer
	 */
	public function getStudentNumber()
	{
		return $this->studentNumber;
	}

	/**
	 * Get the current grade of the student
	 *
	 * @return integer
	 */
	public function getGrade()
	{
		return $this->grade;
	}

	/**
	 * get the entry date
	 *
	 * @return Carbon\Carbon
	 */
	public function getEntryDate()
	{
		return $this->entryDate;
	}

	/**
	 * simplified getter for the entry date
	 *
	 * @return Carbon\Carbon
	 */
	public function entryDate()
	{
		return $this->entryDate;
	}

	/**
	 * get the exit date
	 *
	 * @return Carbon\Carbon
	 */
	public function getExitDate()
	{
		return $this->exitDate;
	}

	/**
	 * simplified getter for the exit date
	 *
	 * @return Carbon\Carbon
	 */
	public function exitDate()
	{
		return $this->exitDate;
	}

	/**
	 * get the gender 'M' or 'F'
	 *
	 * @return string
	 */
	public function getGender()
	{
		return $this->gender;
	}

	/**
	 * get the current school
	 *
	 * @return string
	 */
	public function getCurrentSchool()
	{
		return $this->currentSchool;
	}

	/**
	 * get the date of birth
	 *
	 * @return Carbon\Carbon
	 */
	public function getDob()
	{
		return $this->dob;
	}

	/**
	 * get the student's current age in years
	 *
	 * @return integer
	 */
	public function getYears()
	{
		$now = new DateTime('now');
		$dob = $this->getDob();
		$diff = $dob->diff($now)->format('%y');
		return intval($diff);
	}

	/**
	 * get the student's current age in remainder months
	 *
	 * @return integer
	 */
	public function getMonths()
	{
		$now = new DateTime('now');
		$dob = $this->getDob();
		$diff = $dob->diff($now)->format('%m');
		return intval($diff);
	}

	/**
	 * get the street address
	 *
	 * @return string
	 */
	public function getStreet()
	{
		return $this->street;
	}

	/**
	 * get the city
	 *
	 * @return string
	 */
	public function getCity()
	{
		return $this->city;
	}

	/**
	 * get the zipcode
	 *
	 * @return string
	 */
	public function getZip()
	{
		return $this->zip;
	}

	/**
	 * alternate getter for the zipcode
	 *
	 * @return string
	 */
	public function getZipcode()
	{
		return $this->zip;
	}

	/**
	 * get the state e.g. Utah
	 *
	 * @return string
	 */
	public function getState()
	{
		return $this->state;
	}

	/**
	 * get the full address in one line
	 *
	 * @return string
	 */
	public function getAddress()
	{
		return $this->street . ' '
			. $this->city . ', '
			. $this->state . ' '
			. $this->zip;
	}

	/**
	 * get the next school
	 * @return string
	 */
	public function getNextSchool()
	{
		return $this->nextSchool;
	}

	/**
	 * get the school of enrollment
	 *
	 * @return string
	 */
	public function getEnrollmentSchool()
	{
		return $this->enrollmentSchool;
	}

	/**
	 * get the name of the mother
	 *
	 * @return string
	 */
	public function getMother()
	{
		return $this->mother;
	}

	/**
	 * get the name of the father
	 *
	 * @return string
	 */
	public function getFather()
	{
		return $this->father;
	}

	/**
	 * get one of the parents, mother is prioritized
	 *
	 * @return string
	 */
	public function getParent()
	{
		if (!empty($this->mother)) return $this->mother;

		return $this->father;
	}

	/**
	 * get both parents, one if only one available
	 *
	 * @param string $separator String to separate mother's name and father's name
	 *
	 * @return string
	 */
	public function getParents($separator = '/')
	{
		if (!empty($this->mother) && !empty($this->father)) {
			return "$this->mother $separator $this->father";
		} else if (empty($this->mother)) {
			return $this->father;
		}

		return $this->mother;
	}

	/**
	 * Get the ethnicity of the student
	 *
	 * @return string
	 */
	public function getEthnicity()
	{
		return $this->ethnicity;
	}

	/**
	 * Get the home phone number for the student
	 *
	 * @return string
	 */
	public function getPhone() {
		return $this->phone;
	}

	/**
	 * Get the school's city for the student's current school
	 *
	 * @return string
	 */
	public function getSchoolCity() {
		return $this->schoolCity;
	}

	/**
	 * gets all the properties of the class and supplements it
	 * with extras that have functions associated with them
	 *
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

	/**
	 * Extra function to get the student name "lastname, firstname"
	 *
	 * @return string
	 */
	public function getStudent()
	{
		return $this->getLastFirst();
	}

	/**
	 * Get the student name "lastname, firstname"
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->getLastFirst();
	}

	/**
	 * set the lastname, firstname middlename
	 *
	 * @param $name
	 */
	public function setLastFirst($name)
	{
		if (is_string($name)) {
			if (strpos($name, ',')) {
				$this->lastFirst = $name;
			}
		}
	}

	/**
	 * set the first name
	 *
	 * @param $name
	 * @return void
	 */
	public function setFirstName($name)
	{
		if (is_string($name)) {
			$this->firstName = $name;
		}
	}

	/**
	 * set the middle name
	 *
	 * @param $name
	 */
	public function setMiddleName($name)
	{
		if (is_string($name)) {
			$this->middleName = $name;
		}
	}

	/**
	 * set the last name
	 *
	 * @param $name
	 */
	public function setLastName($name)
	{
		if (is_string($name)) {
			$this->lastName = $name;
		}
	}

	/**
	 * set the student number
	 *
	 * @param $number
	 */
	public function setStudentNumber($number)
	{
		if (is_int($number)) {
			$this->studentNumber = $number;
		}
	}

	/**
	 * Set the current grade of the student
	 *
	 * @param integer $grade
	 */
	public function setGrade($grade)
	{
		if (is_int($grade)) {
			$this->grade = $grade;
		}
	}

	/**
	 * set the entry date
	 *
	 * @param mixed $date
	 */
	public function setEntryDate($date)
	{
		$this->entryDate = $this->setDate($this->entryDate, $date);
	}

	/**
	 * set the exit date
	 *
	 * @param mixed $date
	 */
	public function setExitDate($date)
	{
		$this->exitDate = $this->setDate($this->exitDate, $date);
	}

	/**
	 * set the gender
	 *
	 * @param string $gender
	 */
	public function setGender($gender)
	{
		if (is_string($gender)) {
			if ($gender === 'F' || $gender === 'M') {
				$this->gender = $gender;
			}
		}
	}

	/**
	 * set the current school
	 *
	 * @param string $school
	 */
	public function setCurrentSchool($school)
	{
		if (is_string($school)) {
			$this->currentSchool = $school;
		}
	}

	/**
	 * set the date of birth
	 *
	 * @param mixed $date
	 */
	public function setDob($date)
	{
		$this->dob = $this->setDate($this->dob, $date);
	}

	/**
	 * set the street address
	 *
	 * @param string $street
	 */
	public function setStreet($street)
	{
		if (is_string($street)) {
			$his->street = $street;
		}
	}

	/**
	 * set the city
	 *
	 * @param string $city
	 */
	public function setCity($city)
	{
		if (is_string($city)) {
			$ths->city = $city;
		}
	}

	/**
	 * set the state
	 *
	 * @param string $state
	 */
	public function setState($state)
	{
		if (is_string($state)) {
			$this->state = $state;
		}
	}

	/**
	 * set the zipcode
	 *
	 * @param mixed $zip
	 */
	public function setZip($zip)
	{
		if (is_string($zip)) {
			$this->zip = $zip;
		} else if (is_int($zip)) {
			$this->zip = "$zip";
		}
	}

	/**
	 * alternate setter for the zipcode
	 * 
	 * @param mixed $zip
	 */
	public function setZipcode($zip)
	{
		$this->setZip($zip);
	}

	/**
	 * set the next school
	 *
	 * @param string $school
	 */
	public function setNextSchool($school)
	{
		if (is_string($school)) {
			$this->nextSchool = $school;
		}
	}

	/**
	 * set the school of enrollment
	 *
	 * @param string $school
	 */
	public function setEnrollmentSchool($school)
	{
		if (is_string($school)) {
			$this->enrollmentSchool = $school;
		}
	}

	/**
	 * set the name of the father of the student
	 *
	 * @param string $father
	 */
	public function setFather($father)
	{
		if (is_string($father)) {
			$this->father = $father;
		}
	}

	/**
	 * set the name of the mother of the student
	 *
	 * @param string $mother
	 */
	public function setMother($mother)
	{
		if (is_string($mother)) {
			$this->mother = $mother;
		}
	}

	/**
	 * Set the school's city for the student's current school
	 *
	 * @param string $schoolCity
	 */
	public function setSchoolCity($schoolCity)
	{
		if (is_string($schoolCity)) {
			$this->schoolCity = $schoolCity;
		}
	}

	/**
	 * sets the date to the property if the date is valid
	 *
	 * @param Carbon\Carbon $propertyValue
	 * @param mixed $date 
	 * @return Carbon\Carbon
	 */
	protected function setDate($propertyValue, $date)
	{
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