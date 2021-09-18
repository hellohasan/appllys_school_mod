<?php

namespace App\Helpers;


use Illuminate\Support\Facades\Artisan;

class AppHelper
{

    public static function putPermanentEnv($key, $value)
    {
        $path = app()->environmentFilePath();

        $escaped = preg_quote('=' . env($key), '/');

        file_put_contents($path, preg_replace(
            "/^{$key}{$escaped}/m",
            "{$key}={$value}",
            file_get_contents($path)
        ));
    }

    public static function changeEnv($data = array())
    {
        if (count($data) > 0) {
            $path = app()->environmentFilePath();
            $env = file_get_contents($path);
            $env = preg_split('/(\r\n|\r|\n)/', $env);

            foreach ((array)$data as $key => $value) {
                if (preg_match('/\s/', $value)) {
                    $value = '"' . $value . '"';
                }
                foreach ($env as $env_key => $env_value) {
                    $entry = explode("=", $env_value, 2);
                    if ($entry[0] == $key) {
                        $env[$env_key] = $key . "=" . $value;
                    } else {
                        $env[$env_key] = $env_value;
                    }
                }
            }
            $env = implode("\n", $env);
            file_put_contents($path, $env);

            Artisan::call('config:clear');
            Artisan::call('config:cache');
        }
    }

    public static function getFileExtension($file)
    {
        return explode('/', substr($file, 0, strpos($file, ';')))[1];
    }
}
