<?php

namespace App\DataParser;

use App\Contracts\DataProvider;

class DataProviderX extends DataParser implements DataProvider
{
    public const AUTHORIZED = 1;
    public const DECLINE = 2;
    public const REFUNDED = 3;

    public function toArray($data): array
    {
        $result= [];
        foreach ($data as $item) {
            $result[]= [
               'Balance' => $item['parentAmount'],
               'Currency' => $item['Currency'],
               'Email' => $item['parentEmail'],
               'StatusCode' => strtolower($this->getConstList()[$item['statusCode']]),
               'Date' => $item['registerationDate'],
               'Parent' =>$item['parentIdentification']
           ];
        }

        return $result;
    }
}
