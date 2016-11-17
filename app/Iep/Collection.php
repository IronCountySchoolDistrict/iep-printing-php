<?php

namespace App\Iep;

class Collection extends \Illuminate\Support\Collection
{
    /**
     * Collection constructor.
     * @param array $items
     */
    public function __construct($items = [])
    {
        if (is_array($items)) {
            foreach ($items as $item) {
                if (is_array($item)) {
                    $this->items[$item['field']] = [
                        'field' => $item['field'],
                        'type' => $item['type'],
                        'response' => $item['response'],
                    ];
                } else {
                    $this->items[$item->field] = [
                        'field' => $item->field,
                        'type' => $item->type,
                        'response' => $item->response,
                    ];
                }
            }
        } else {
            $this->items = $this->getArrayableItems($items);
        }
    }

    /**
     * get function that returns 'response' field.
     *
     * @param string $key
     * @param string $default [description]
     * @param bool $flatten if the element matching $key is an array, should the return value be a string or array?
     *
     * @return string|array return string value of response, or, if $flatten
     *                      is true, return the array as the value
     */
    public function get($key, $flatten = false, $default = null)
    {
        if ($this->offsetExists($key)) {
            if ($flatten && $this->items[$key]['response'] != null && is_array($this->items[$key]['response'])) {
                $array_str = implode(', ', $this->items[$key]['response']);

                return $array_str;
            } else {
                return $this->items[$key]['response'];
            }
        }

        return value($default);
    }
}
