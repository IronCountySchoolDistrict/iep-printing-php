<?php

namespace App\Iep;

class Collection extends \Illuminate\Support\Collection {

	public function __construct($items = []) {
		if (is_array($items)) {
			foreach ($items as $item) {
				$this->items[$item->field] = [
					'field' => $item->field,
					'type' => $item->type,
					'response' => $item->response
				];
			}
		} else {
			$this->items = $this->getArrayableItems($items);
		}
	}

	/**
	 * get function that returns 'response' field
	 * @param  string  $key
	 * @param  string  $default [description]
	 * @param  boolean $flatten should the return value be a string or array?
	 * @return string|array     return string value of response, or, if $flatten
	 * is true, return the array as the value
	 */
	public function get($key, $flatten = False, $default = NULL) {
		if ($this->offsetExists($key)) {
			if ($flatten) {
				return implode(', ', $this->items[$key]['response']);
			} else {
				return $this->items[$key]['response'];
			}
    }

    return value($default);
	}
}
