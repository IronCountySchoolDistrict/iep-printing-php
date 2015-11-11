<?php

namespace App\Iep\Legacy;

use Carbon\Carbon;

class Pdf extends \mikehaertl\pdftk\Pdf {
    public $id;
    public $fields = [];

    public function getField($key)
	{
		if (isset($this->fields[$key])) {
			return $this->fields[$key];
		}

		return null;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getFields()
	{
		return $this->fields();
	}

	public function fields()
	{
		return $this->fields;
	}

	public function missing()
	{
		return count(array_filter($this->fields, function($value) {
			return empty($value);
		}));
	}

	public function setId($id)
	{
			$this->id = $id;
	}

	public function setField($key, $value)
	{
		$this->fields[$key] = $value;
	}

	public function setFields($data)
	{
		if (is_string($data)) {
			$fields = [];
			$lines = explode(PHP_EOL, $data);
			foreach ($lines as $key => $line) {
				if (strpos($line, 'FieldName: ') !== false) {
					$fields[str_replace('FieldName: ', '', $line)] = '';
				}
			}

			$this->fields = $fields;
		} else if (is_array($data)) {
			$this->fields = $data;
		}
	}

	public function addStudent(Student $student)
	{
		foreach ($this->fields as $name => $value) {
			if (empty($value)) {
				$closest = ['distance' => 100, 'word' => ''];
				foreach ($student->getProperties() as $propertyName) {
					$distance = levenshtein(strtolower($name), $propertyName);
					if ($distance < $closest['distance']) {
						$closest = ['distance' => $distance, 'word' => $propertyName];
					}
					if ($distance == 0) break;
				}

				if ($closest['distance'] < 3) {
					$function = camel_case('get_' . $closest['word']);

					$this->fields[$name] = $student->{$function}();

					if ($this->fields[$name] instanceof Carbon) {
						$this->fields[$name] = $this->fields[$name]->format('m/d/Y');
					}
				}
			}
		}
	}

	public function save()
	{
		$filepath = public_path() . DIRECTORY_SEPARATOR . 'download' . DIRECTORY_SEPARATOR . str_random(20) . '.pdf';
		$this->fillForm($this->fields)
			->flatten()
			->needAppearances()
			->saveAs($filepath);

		if (empty($this->_error)) {
			return $filepath;
		} else {
			return $this->_error;
		}
	}
}
