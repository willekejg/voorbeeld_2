<?php

namespace controller;

use model\PersonRepository;
use model\ModelException;
use view\JsonView;

class PersonController
{
    private $personRepository;
    private $personView;

    public function __construct(PersonRepository $personRepository, JSonView $personView, JSonView $personsView)
    {
        $this->personRepository = $personRepository;
        $this->personView = $personView;
        $this->personsView = $personsView;
    }

    public function handleFindPersonById($id)
    {
        $statuscode=200;
        $person=null;
        try {
            $person = $this->personRepository->findPersonById($id);
            if ($person==null) {
                 $statuscode=204;
            }
        } catch (ModelException $exception) {
            $statuscode=500;
        }
        $this->personView->show(['person' => $person], $statuscode);
    }

    public function handleFindPersons()
    {
        $statuscode=200;
        $persons=[];
        try {
            $persons = $this->personRepository->findPersons();
        } catch (ModelException $exception) {
            $statuscode=500;
        }
        $this->personsView->show(['persons' => $persons], $statuscode);
    }
}
