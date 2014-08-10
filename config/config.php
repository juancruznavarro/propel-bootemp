<?php
echo '<pre>';
print_r($_SERVER);

echo $_SERVER['DOCUMENT_ROOT'];
die;

error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set("display_errors", 1);




define('SITE_TITLE','Administrador :: ');
define('SITE_PATH','/var/www/propel-bootemp');
define('SITE_PATH_ADMIN', SITE_PATH.'/admin');
define('SITE_PATH_CONFIG',SITE_PATH.'/config');
define('SITE_PATH_CONFIG_PROPEL',SITE_PATH.'/config/propel-bootemp-conf.php');
define('SITE_PATH_MODULES',SITE_PATH_ADMIN.'/modules');
define('SITE_DEBUG', false);


require_once 'drivers.php';

session_start();

?>
