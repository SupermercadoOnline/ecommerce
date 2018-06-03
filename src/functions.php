<?php
include_once __DIR__ . '/configs.php';

function get_somente_numeros_string(string $string){
    return preg_replace('/[^0-9]/', '', $string);
}

function get_string_datetime_atual(){
    return date('Y-m-d H:i:s');
}

function data_php_to_data_br(string $data_php){

    $data_br = DateTime::createFromFormat('Y-m-d', $data_php);
    if($data_br){

        return $data_br->format('d/m/Y');

    }

    $data_br = $data_br = DateTime::createFromFormat('Y-m-d H:i', $data_php);
    if($data_br){

        return $data_br->format('d/m/Y H:i');

    }

    $data_br = $data_br = DateTime::createFromFormat('Y-m-d H:i:s', $data_php);
    if($data_br){

        return $data_br->format('d/m/Y H:i:s');

    }

    return null;

}
function data_br_to_data_php(string $data_br){

    $data_php = DateTime::createFromFormat('d/m/Y', $data_br);
    if($data_php){

        return $data_php->format('Y-m-d');

    }

    $data_php = DateTime::createFromFormat('d/m/Y H:i', $data_br);
    if($data_php){

        return $data_php->format('Y-m-d H:i');

    }

    $data_php = DateTime::createFromFormat('d/m/Y H:i:s', $data_br);
    if($data_php){

        return $data_php->format('Y-m-d H:i:s');

    }

    return null;

}
