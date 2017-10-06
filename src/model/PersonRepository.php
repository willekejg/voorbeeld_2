<?php

namespace model;

interface PersonRepository
{
    public function findPersonById($id);
    public function findPersons();
}
