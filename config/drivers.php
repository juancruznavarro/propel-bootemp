<?php
// PROPEL
require_once SITE_PATH.'/vendors/propel/runtime/lib/Propel.php';
Propel::init(SITE_PATH_CONFIG_PROPEL);
set_include_path(SITE_PATH_MODULES . PATH_SEPARATOR . get_include_path());

// SMARTY
require_once SITE_PATH.'/vendors/smarty/libs/SmartyTemplate.class.php';

// SWIFT MAILER
require_once SITE_PATH.'/vendors/swiftmailer/lib/swift_required.php';

?>
