<?php

$page = $_GET["page"];



if(!isset($page )){
    include(THEME ."pages/login.php");
}
else{
    include(THEME ."pages/". $page .".php");
}

