<?php

namespace App\DataParser;

use App\Contracts\DataProvider;

class DataProviderY extends DataParser implements DataProvider
{
    public const AUTHORIZED = 100;
    public const DECLINE = 200;
    public const REFUNDED = 300;

    public function toArray($data): array
    {
        $result = [];
        foreach ($data as $item) {
            $result[] = [
                'Balance' => $item['balance'],
                'Currency' => $item['currency'],
                'Email' => $item['email'],
                'StatusCode' =>  strtolower($this->getConstList()[$item['status']]),
                'Date' => $item['created_at'],
                'Parent' => $item['id']
            ];
        }
        return $result;
    }
}
