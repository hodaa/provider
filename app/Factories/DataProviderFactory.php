<?php

namespace App\Factories;

use App\Contracts\DataProvider;

class DataProviderFactory
{
    /**
     * @param $filename
     * @return mixed
     */
    public static function create(string $filename): object
    {
        $array = explode('/', $filename);
        $className = explode('.', array_pop($array))[0];
        $className = "App\\DataParser\\" . $className;

        if(!class_exists($className)){
            throw new \Exception("$className doesn't exist");
        }
        return new $className;





    }
}
