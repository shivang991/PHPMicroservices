<?php

function dd(mixed $data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}

$uri = parse_url($_SERVER["REQUEST_URI"])["path"];

// APIs
if (str_starts_with($uri, "/api/test")) {
    echo json_encode(["status" => "success", "message" => "Success from test"]);
    exit();
}
if (str_starts_with($uri, "/api")) {
    echo json_encode(["status" => "success", "message" => "APIs"]);
    exit();
}