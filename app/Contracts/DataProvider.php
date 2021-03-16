<?php


namespace App\Contracts;

interface DataProvider
{
    public function toArray(array $data) : array;
}
