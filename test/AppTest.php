<?php
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class AppTest extends TestCase
{
    const IP='http://192.168.33.22/';
    public function setUp()
    {
        $this->client = new Client();
    }

    public function tearDown()
    {
        $this->client=null;
    }

    public function testGetId_idExists_Status200PersonObject()
    {
        $id=1;
        $name="jan";
        $response = $this->client->get(self::IP . "app.php?id=$id");
        $statuscode = $response->getStatusCode();
        $body = $response->getBody();
        $jsonArray = json_decode($body, true);
        $this->assertEquals('200', $statuscode);
        $this->assertEquals($id, $jsonArray["id"]);
        $this->assertEquals($name, $jsonArray["name"]);
    }
}
