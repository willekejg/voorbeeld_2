<?php

namespace view;

class PersonsJsonView implements JSonView
{
    public function show(array $data, $statuscode)
    {
        header('Content-Type: application/json');
        http_response_code($statuscode);
        $persons = $data['persons'];
        echo json_encode($persons);
    }
}
