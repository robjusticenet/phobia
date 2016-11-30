<?php
if(!defined('mnminclude')){header('Location: ../error_404.php');die();}

define("EZSQL_DB_USER", "phobia_rjnet");
define("EZSQL_DB_PASSWORD", "Q3F8RKWr");
define("EZSQL_DB_NAME", "phobia");
define("EZSQL_DB_HOST", "mysql.robjustice.net");
if (!function_exists('gettext')) {
	function _($s) {return $s;}
}
?>
