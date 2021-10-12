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


if(!function_exists('Redirect')){
   function Redirect($url, $code = 302) //from http://stackoverflow.com/questions/768431/how-to-make-a-redirect-in-php
   {
     #echo 'redirecting';
     if (strncmp('cli', PHP_SAPI, 3) !== 0)
     {
       #echo 'cli';
       if (headers_sent() !== true)
       {
         if (strlen(session_id()) > 0) // if using sessions
         {
             session_regenerate_id(true); // avoids session fixation attacks
             session_write_close(); // avoids having sessions lock other requests
         }
         if (strncmp('cgi', PHP_SAPI, 3) === 0)
         {
             header(sprintf('Status: %03u', $code), true, $code);
         }
       header('Location: ' . $url, true, (preg_match('~^30[1237]$~', $code) > 0) ? $code : 302);
       } else { //headers have already been sent. Use Meta refresh with js location.href fallback
       ?>
         <em>This page has moved.</em><br />
         If you are not redirected automatically please follow this link: <a href=\"<?php echo $url; ?>"><?php echo $url; ?></a>.
         <meta http-equiv="Refresh" content="1;
         URL=<?php echo $url; ?>">
         <script language=javascript>
         setTimeout("location.href='<?php echo $url; ?>'",1);
         </script>
         <?php
       }//end if headers_sent
  
       exit();
     }
   }
}



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


if (version_compare(phpversion(), '8', '<')) {
   if((!isset($_SESSION['login']) && $_SESSION['login'] == '') && $page != "login"){
      header("Location: ". url("/?page=login"));
   }
}
else{
   if((!isset($_SESSION['login']) && $_SESSION['login'] == '') && $page != "login"){
      header("Location: ". url("/?page=login"));
   }
   else if(($connection == false || $connection == "") && $page != "settings"){
      header("Location: ". url("/?page=settings"));
   }
}




// die();


//$connection = true;

//ob_start("ob_gzhandler");


include("themes/default/index.php");

echo '<pre>';
print_r($_GET);
print_r($_SESSION);
echo 'connection: '. $connection;
echo 'page: '. $page;
echo '</pre>';

