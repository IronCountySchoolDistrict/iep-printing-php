<?php namespace App\Iep;

class Response {
  public $responses = [];

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
    foreach ($this->responses as $response) {
      if ($response['field'] == $field) return $response['value'];
    }

    return null;
  }

  /**
   * Executes a callback over each item
   * @param callable $callback
   * @return $this
   */
  public function each(callable $callback) {
    foreach ($this->responses as $key => $response) {
      if ($callback($response, $key) === false) {
        break;
      }
    }

    return $this;
  }

}
