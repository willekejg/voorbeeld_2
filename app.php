<?php
require "vendor/autoload.php";
use model\PDOPersonRepository;
use model\PDOPersonDAO;
use view\PersonJsonView;
use view\PersonsJsonView;
use controller\PersonController;

$user = 'root';
$password = 'root';
$database = 'persondb';
$server = 'localhost';
$pdo = null;

$pdo = new PDO("mysql:host=$server;dbname=$database", $user, $password);
$pdo->setAttribute(
    PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION
);

$personDAO = new PDOPersonDAO($pdo);
$personRepository = new PDOPersonRepository($personDAO);
$personJsonView = new PersonJsonView();
$personsJsonView = new PersonsJsonView();
$personController = new PersonController($personRepository, $personJsonView, $personsJsonView);

if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $personController->handleFindPersonById($id);

} else {
        $personController->handleFindPersons();
}
