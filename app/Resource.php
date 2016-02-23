<?php

namespace App;

class Resource {

  public static function elixir($asset) {
    $asset = elixir($asset);
    if (starts_with($asset, '/')) {
      $asset = substr($asset, 1);
    }

    return $asset;
  }

  public static function asset($asset) {
    return asset($asset);
  }

  public static function secure_asset($asset) {
    return secure_asset($asset);
  }
}
