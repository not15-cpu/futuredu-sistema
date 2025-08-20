<?php 

session_start();

//Carregando as configurações iniciais!
require_once('../config/config.php');


$caminho = new Routes();
$caminho->execute();
