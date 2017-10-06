<?php
use PHPUnit\Framework\TestCase;
use \model\Person;
use \model\PDOPersonDAO;

class PDOPersonDAOTest extends TestCase
{
    public function setUp()
    {
        $this->connection = new PDO('sqlite::memory:');
        $this->connection->exec('CREATE TABLE person (
                        id INT, 
                        name VARCHAR(255),
                        PRIMARY KEY (id)
                   )');
    }

    public function tearDown()
    {
        $this->connection=null;
    }

    public function testFindById_idExists_PersonObject()
    {
        $name="testname";
        $id = 1;
        $person = new Person($id, $name);
        $this->connection->exec("INSERT INTO person (id, name) VALUES (1,'$name');");
        $personDAO=new PDOPersonDAO($this->connection);
        $actualPerson = $personDAO->findById($id);
        $this->assertEquals($person, $actualPerson);
    }

    public function testFindById_idDoesNotExist_Null()
    {
        $id=1;
        $personDAO=new PDOPersonDAO($this->connection);
        $actualPerson = $personDAO->findById($id);
        $this->assertNull($actualPerson);
    }

    /**
     * @expectedException model\ModelException
    **/
    public function testFindPersonById_tablePersonDoesntExist_ModelException()
    {
        $this->connection->exec("DROP TABLE person");
        $personDAO=new PDOPersonDAO($this->connection);
        $actualPerson = $personDAO->findById(1);
    }
}
