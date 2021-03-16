<?php


class DataProviderTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testResponseIsOK()
    {
        $response = $this->get('/api/v1/users');
        $this->assertEquals(200, $response->response->status());
    }
    public function testResponseWithFilter()
    {

        $response = $this->get('api/v1/users?provider=DataProviderR')
            ->seeJsonEquals([
                'provider' => ['This Provider Type is not valid'],
            ])->assertResponseStatus(422);
    }
}
