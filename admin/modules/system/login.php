<?php
// POST
if(!empty($_POST['action'])){

	$usr = SistemaUsuarioQuery::create();
	$usr->filterByNick($_POST['user']);
	$usr->filterByPassword(md5($_POST['password']));
	$usr->filterByActivo('Y');
	$usuario = $usr->findOne();

    if(!$usuario){
		header('Location: index.php?e=1');exit;
	}else{
		//------ SESSION --------
		$_SESSION['log'] = array();
        $_SESSION['log']['user'] = $usuario;
		$_SESSION['log']['ini'] = time();
		$_SESSION['log']['menu'] = null;
        $_SESSION['profile'] = array(
            'fullName' => ($usuario->getFirstName()) ? $usuario->getFirstName() . ' ' . $usuario->getLastName() : $usuario->getNick(),

        );


		$recursos = array();
		$nxm = SistemaNivelModuloQuery::create()->filterByIdSistemaNivel($usuario->getIdSistemaNivel())->orderByPosicion()->find();
		foreach($nxm as $nm){
			//$nm = new SistemaNivelModulo();
            $recursos[$nm->getSistemaModulo()->getId()]['nombre'] = $nm->getSistemaModulo()->getEtiqueta();
            $recursos[$nm->getSistemaModulo()->getId()]['ico'] = $nm->getSistemaModulo()->getIco();
			$recs = SistemaRecursoQuery::create()->filterBySistemaModulo($nm->getSistemaModulo())->orderByPosicion()->find();
			foreach($recs as $r){
				//$r = new SistemaRecurso();
				$recursos[$nm->getSistemaModulo()->getId()]['links'][] = array(
					'label' => $r->getEtiqueta(),
				    'url' => 'module='.$nm->getSistemaModulo()->getNombre().'&view='.$r->getNombre(),
					'visible' => $r->getVisible()
				);
			}
		}

		$_SESSION['log']['menu'] = $recursos;
		header('Location: index.php?e=o');exit;
	}
}

// GET
$titulo = 'Ingreso al Sistema';
$descripcion = '';
$templatePrincipal = 'login.html';
$template = null;
$html = null;
$menuNav = null;


$smarty = new SmartyTemplate();
$smarty->setTemplateDir(SITE_PATH.'/templates/');
$smarty->assign('html',$html);
$smarty->assign('mod_css',$mod_css);
$smarty->assign('mod_js',$mod_js);
$smarty->assign('menuNav', '');
$smarty->fetch($templatePrincipal);


?>