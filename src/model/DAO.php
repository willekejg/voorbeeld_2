<?php

namespace model;

interface DAO
{
    public function findByID($id);
    public function findAll();
    /*
    public function add($object);
    public function delete($id);
	public function update($object);
     */
}
