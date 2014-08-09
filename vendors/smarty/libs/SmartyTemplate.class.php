<?php
require_once 'Smarty.class.php';

class SmartyTemplate extends Smarty{
	private $_principal = false;

	/**
	 * Motor de plantilla Smarty
	 * Especifica si se genera para la plantilla principal
	 *
	 * @param Boolean $principal
	 */
	function __construct($principal=false){
		global $module, $view;

		$this->_principal = $principal;

		parent::__construct();

		$this->setCompileDir(SITE_PATH.'/templates_c/');
		$this->setConfigDir(SITE_PATH.'/config/');

		/**
		 * CARGAMOS DINAMICAMENTE LOS CSS Y JS CORRESPONDIENTES A CADA MODULO
		 */
		if($principal){
			// CSS
			$head_css = NULL;
			if($handler = opendir(SITE_PATH_ADMIN.'/modules/'.$module.'/templates/css')){
				while(false!==($arch=readdir($handler))){
					if($arch!='.' && $arch!='..' && $arch!='.svn'){
						$head_css .= '<link rel="stylesheet" href="modules/'.$module.'/templates/css/'.$arch.'" type="text/css" />'."\r\n";
					}
				}
			}
			$this->assign('head_css',$head_css);

			// JS
			$head_js = NULL;
			if($handler = opendir(SITE_PATH_ADMIN.'/modules/'.$module.'/templates/js')){
				while(false!==($arch=readdir($handler))){
					if($arch!='.' && $arch!='..' && $arch!='.svn'){
						$head_js .= '<script type="text/javascript" src="modules/'.$module.'/templates/js/'.$arch.'"></script>'."\r\n";
					}
				}
			}
			$this->assign('head_js',$head_js);
		}

		$this->assign('tituloPagina',SITE_TITLE);
		if(!empty($module)){
			$this->assign('module',$module);
			if(file_exists(SITE_PATH_ADMIN.'/modules/'.$module.'/templates'))
			$this->setTemplateDir(SITE_PATH_ADMIN.'/modules/'.$module.'/templates/');
		}
		if(!empty($view))
		$this->assign('view',$view);
		if(!empty($_REQUEST['action']))
		$this->assign('action',$_REQUEST['action']);
	}
}
?>