<?php

namespace model;

class PDOPersonDAO implements DAO
{
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findByID($id)
    {
        try {
            $statement = $this->connection->prepare('SELECT * FROM person WHERE id=?');
            if ($statement==false) {
                throw new ModelException("Problem with PDOStatement");
            }
            $statement->bindParam(1, $id, \PDO::PARAM_INT);
            $statement->execute();
            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);
            if (count($results) > 0) {
                return new Person($results[0]['id'], $results[0]['name']);
            } else {
                return null;
            }
        } catch (\PDOException $exception) {
            throw new ModelException("PDO Exception.", 0, $exception);
        }
    }

    public function findAll()
    {
        try {
            $statement = $this->connection->prepare('SELECT * FROM person');
            if ($statement==false) {
                throw new ModelException("Problem with PDOStatement");
            }
            $statement->execute();
            $persons = [];
            $statement->setFetchMode(\PDO::FETCH_ASSOC);
            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($results as $person) {
                $persons[] = new Person($person['id'], $person['name']);
            }
            return $persons;
        } catch (\PDOException $exception) {
            throw new ModelException("PDO Exception.", 0, $exception);
        }
    }
}
