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

	public function get($key, $default = NULL) {
		if ($this->offsetExists($key)) {
            return $this->items[$key]['response'];
        }

        return value($default);
	}
}