<?php

namespace model;

class PDOPersonRepository implements PersonRepository
{
    private $personDAO = null;

    public function __construct(PDOPersonDAO $personDAO)
    {
        $this->personDAO = $personDAO;
    }

    public function findPersonById($id)
    {
        $person=null;
        if ($this->isValidId($id)) {
                $person = $this->personDAO->findById($id);
        }
        return $person;
    }

    public function findPersons()
    {
        $persons = $this->personDAO->findAll();
        return $persons;
    }

    private function isValidId($id)
    {
        if (is_string($id) && ctype_digit(trim($id))) {
            $id=(int)$id;
        }
        return is_integer($id) and $id >= 0;
    }
}
