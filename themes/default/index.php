<?php

$page = $_GET["page"];

if (!$API->connect($config->mikrotik->ip_address, $config->mikrotik->user, decrypt($config->mikrotik->password)) && $_GET["page"] != "settings"){
    header("Location:". url("/?page=settings"));
}


if(!isset($page )){
    include(THEME ."pages/login.php");
}
else{
    include(THEME ."pages/". $page .".php");
}

