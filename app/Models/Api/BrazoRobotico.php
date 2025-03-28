<?php

namespace App\Models\Api;

use Illuminate\Support\Facades\Http;

class BrazoRobotico
{
    protected static $endpoint = '/brazos-roboticos';

    public static function all()
    {
        $response = Http::get(env('API_BASE_URL').self::$endpoint);
        return $response->successful() ? $response->json() : [];
    }

    public static function find($id)
    {
        $response = Http::get(env('API_BASE_URL').self::$endpoint.'/'.$id);
        return $response->successful() ? $response->json() : null;
    }

    public static function create($data)
    {
        return Http::post(env('API_BASE_URL').self::$endpoint, $data);
    }

    public static function update($id, $data)
    {
        return Http::put(env('API_BASE_URL').self::$endpoint.'/'.$id, $data);
    }

    public static function delete($id)
    {
        return Http::delete(env('API_BASE_URL').self::$endpoint.'/'.$id);
    }
}