<?php
namespace App;
class ElixirResource
{
    public static function elixir($asset)
    {
        $asset = elixir($asset);
        if (starts_with($asset, '/')) {
            $asset = substr($asset, 1);
        }
        if (env('API_URL_PREFIX')) {
            $asset = env('API_URL_PREFIX') . $asset;
        }
        return $asset;
    }

    public static function asset($asset)
    {
        return asset($asset);
    }

    public static function secure_asset($asset)
    {
        return secure_asset($asset);
    }
}