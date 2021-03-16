<?php

use App\Services\DataProviderService;

class DataProviderServiceTest extends TestCase
{
    private $dataProviderService;
    private $data;

    public function setUp():void
    {
        $this->dataProviderService = new DataProviderService();
        $this->data =[
            [
                "Balance"=> 280,
                "Currency"=> "EUR",
                "Email"=> "parent1@parent.eu",
                "StatusCode"=> "authorised",
                "Date"=> "2018-11-30",
                "Parent"=> "d3d29d70-1d25-11e3-8591-034165a3a613"
            ],[
                "Balance"=> 200.5,
                "Currency" => "USD",
                "Email" => "parent2@parent.eu",
                "StatusCode"=> "decline",
                "Date" => "2018-01-01",
                "Parent" => "e3rffr-1d25-dddw-8591-034165a3a613"
            ],
            [
                "Balance"=> 500,
                "Currency" => "EGP",
                "Email" => "parent3@parent.eu",
                "StatusCode"=>"authorised",
                "Date" => "2018-02-27",
                "Parent" => "4erert4e-2www-wddc-8591-034165a3a613"
            ]
        ];
    }
    public  function testFilter(){


        $filters=['statusCode'=>'authorised'];
        $result = $this->dataProviderService->filter($this->data, $filters);
        $this->assertNotEmpty($result);
        $this->assertCount(2,$result);

        $filters = ['balanceMin'=>10, 'balanceMax'=>100];
        $result = $this->dataProviderService->filter($this->data, $filters);
        $this->assertEmpty($result);


    }
    public function testFilterCurrency(){
        $filters = ['currency'=>'USD'];
        $result = $this->dataProviderService->filter($this->data, $filters);
        $this->assertCount(1,$result);
    }

    public function testAllFilterCurrency(){
        $filters = [
            'currency'=>'USD',
            'statusCode' => 'decline',
            'balanceMin'=>100,
            'balanceMax'=>300
        ];
        $result = $this->dataProviderService->filter($this->data, $filters);
        $this->assertCount(1,$result);
    }
}
