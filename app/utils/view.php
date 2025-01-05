<?php

function view($file, $data = []) {
    extract($data); 
    include __DIR__."/../view/{$file}.php";
}

?>