<?php

namespace  App\Services;

use App\Contracts\DataProvider;
use App\Factories\DataProviderFactory;
use Illuminate\Support\Collection;

class DataProviderService
{
    /**
     * @var string[]
     */
    private $allowedFilters = [
        'provider',
        'statusCode',
        'balanceMin',
        'balanceMax',
        'currency'
    ];

    /**
     * @param string $fileName
     * @return array
     */
    public function extractData(string $fileName): array
    {
        if (file_exists($fileName)) {
            $string = file_get_contents($fileName);
            $data = json_decode($string, true);
            unset($string); // to free memory after each file
            $objName = DataProviderFactory::create($fileName);


            return $this->getParsedData($objName,$data['users']) ;
        }
    }

    /**
     * @param DataProvider $dataProvider
     * @param $data
     * @return array
     */
    private function getParsedData(DataProvider $dataProvider,array $data): array
    {
        return $dataProvider->toArray($data);
    }

    /**
     * @param $result
     * @param $filters
     * @return Collection|mixed|\Tightenco\Collect\Support\Collection
     */
    public function filter($result, $filters): array
    {
        if (isset($filters['balanceMin']) && isset($filters['balanceMax'])) {

            $min = $filters['balanceMin'];
            $max = $filters['balanceMax'];
            $result = array_filter($result,function ($value) use ($min, $max) {
                return $value['Balance'] >= $min && $value['Balance'] <= $max;
            });
        }
        foreach ($filters as $column => $filter) {
            if ($column =='balanceMin'|| $column =='balanceMax' || $column == 'provider' || !in_array($column,$this->allowedFilters)) {
                continue;
            }

            $result = array_filter($result,function ($value) use ($column, $filter) {
                return $value[ucfirst($column)]== $filter;
            });
        }
        return array_values($result);
    }

}
