<?php
include_once '../model/EstadosDAO.php';

$estadosDAO = new EstadosDAO();
foreach ($estadosDAO->getAll() as $estadoBean)
    if($estadoBean instanceof EstadosBean)
        echo $estadoBean->getNome() . '<br>';
