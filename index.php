<?php
/*
 *  Copyright (C) 2021 Russell Pabon.
 *
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

 
session_start();
// hide all error
error_reporting(0);
// check url


// error_reporting(E_ALL);
// ini_set('display_errors', TRUE);
// ini_set('display_startup_errors', TRUE);



ini_set("max_execution_time", 10); 
date_default_timezone_set('Asia/Manila');

define('ROOT', dirname(__FILE__));
define('THEME', ROOT ."/themes/default/");

require_once("include/config.php");
require_once("include/validation.php");
require_once("include/formatbytesbites.php");
require_once("include/routeros_api.class.php");

$API = new RouterosAPI(); 

$page = isset($_GET["page"]) ? trim($_GET["page"]) : "login";


$connection = $API->connect($config->mikrotik->ip_address, $config->mikrotik->user, decrypt($config->mikrotik->password));

if($page == "logout"){
   header("Location:". url("/?page=logout"));
}
else if((!isset($_SESSION['login']) || $_SESSION['login'] == '') && $page != "login"){
   header("Location:". url("/?page=login"));
}
else if($connection == false && $page != "settings"){
   header("Location:". url("/?page=settings"));
}

//  echo '<pre>';
// print_r($_SESSION);
// echo 'connection: '. $connection;
// echo '</pre>';

// die();


//$connection = true;

//ob_start("ob_gzhandler");


include("themes/default/index.php");
