<?php
use PHPUnit\Framework\TestCase;
use \model\Person;
use \model\PersonDAO;
use \model\PDOPersonRepository;

class PDOPersonRepositoryTest extends TestCase
{
    public function setUp()
    {
        $this->mockPersonDAO = $this->getMockBuilder('\model\PDOPersonDAO')
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function tearDown()
    {
        $this->mockPersonDAO = null;
    }

    public function testFindPersonById_idExists_PersonObject()
    {
        $id = 1;
        $name= 'testperson';
        $person = new Person($id, $name);
        $this->mockPersonDAO->expects($this->atLeastOnce())
            ->method('findById')
            ->with($this->equalTo($id))
            ->will($this->returnValue($person));
        $personRepository = new PDOPersonRepository($this->mockPersonDAO);
        $actualPerson = $personRepository->findPersonById($id);
        $this->assertEquals($person, $actualPerson);
    }

    public function testFindPersonById_idDoesNotExist_Null()
    {
        $id = 1;
        $this->mockPersonDAO->expects($this->atLeastOnce())
            ->method('findById')
            ->with($this->equalTo($id))
            ->will($this->returnValue(null));
        $personRepository = new PDOPersonRepository($this->mockPersonDAO);
        $actualPerson = $personRepository->findPersonById($id);
        $this->assertNull($actualPerson);
    }

     /**
     * @dataProvider invalidIDProvider
     */
    public function testFindPersonById_invallidID_Null($id)
    {
        $personRepository = new PDOPersonRepository($this->mockPersonDAO);
        $actualPerson = $personRepository->findPersonById($id);
        $this->assertNull($actualPerson);
    }

    public function invalidIDProvider()
    {
        return [
            ["a"],
            ["-1"],
            [-1],
            [new stdClass()]
        ];
    }
}
