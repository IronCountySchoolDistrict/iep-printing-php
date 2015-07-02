<?php namespace App\Iep;

class Response {
  public $responses;

  /**
   * creates a new instance of Response
   *
   * @return void
   */
  public function __construct($responses)
  {
    foreach ($responses as $response) {
      $this->responses[] = [
        'field' => $response->field,
        'type' => $response->type,
        'value' => $response->response
      ];
    }
  }

  /**
   * gets responses that match the arguments
   * @param $key The array key e.g. 'feild', 'type', or 'value'
   * @param $value What the key's value should be
   * @return array|null
   */
  public function find($key, $value)
  {
    foreach ($this->responses as $response) {
      if ($response[$key] == $value) $matches[] = $response;
    }

    return (isset($matches)) ? $matches : null;
  }

  /**
   * gets the value of the given field
   * @param string $field
   * @return string
   */
  public function get($field)
  {
    $index = array_search($field, array_column($this->responses, 'field'));

    return ($index >= 0) ? $this->responses[$index]['value'] : null;
  }

}
