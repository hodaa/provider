<?php


namespace App\DataParser;

use App\Contracts\DataProvider;
use App\Enums\Enum;

class DataProviderX extends DataParser implements DataProvider
{
    const AUTHORIZED = 1;
    const DECLINE = 2;
    const REFUNDED = 3;

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
