<?php
require_once '../config/config.php';

$module = 'system';
$view = 'login';
$templatePrincipal = 'root.html';
$html = null;
$menuNav = null;

//--- SI ESTA LOGUEADO ----
if(!empty($_SESSION['log'])){
	$menuNav = $_SESSION['log']['menu'];
	$module = 'system';
	$view = 'home';

	if(!empty($_REQUEST['module'])){
		if(is_dir(SITE_PATH_ADMIN.'/modules/'.$_REQUEST['module'])){
			if(file_exists(SITE_PATH_ADMIN.'/modules/'.$_REQUEST['module'].'/'.$_REQUEST['view'].'.php')){
				$module = $_REQUEST['module'];
				$view = $_REQUEST['view'];
			}
		}
	}

}

/**
 * VISTAS
 */
$mod_css = null;
$mod_js = null;

require_once 'modules/'.$module.'/'.$view.'.php';

$smarty = new SmartyTemplate(true);
$smarty->setTemplateDir(SITE_PATH.'/templates/');
$smarty->assign('html',$html);
$smarty->assign('mod_css',$mod_css);
$smarty->assign('mod_js',$mod_js);
$smarty->assign('menuNav',$menuNav);
$smarty->display($templatePrincipal);
?>
