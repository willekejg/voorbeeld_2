<?php
namespace view;

class PersonJsonView implements JsonView
{
    public function show(array $data, $statuscode)
    {
        header('Content-Type: application/json');
        http_response_code($statuscode);
        $person = $data['person'];
        echo json_encode($person);
    }
}
