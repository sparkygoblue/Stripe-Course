<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $event = file_get_contents("php://input");

    $file = fopen('webhook.txt', 'w');
    fwrite($file, $event);
}
