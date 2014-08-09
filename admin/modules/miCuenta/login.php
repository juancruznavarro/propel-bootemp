<?php
// POST
if(!empty($_POST['action'])){
	$usr = SistemaUsuarioQuery::create();
	$usr->filterByNick($_POST['usuario']);
	$usr->filterByPassword(md5($_POST['clave']));
	$usr->filterByActivo('Y');
	$usuario = $usr->find();

	if($usr->count()!=1){
		header('Location: index.php?e=1');exit;
	}else{
		//------ SESSION --------
		$_SESSION['log'] = array();
		$_SESSION['log']['usuario'] = $usuario[0];
		$_SESSION['log']['ini'] = time();
		$_SESSION['log']['menu'] = null;

		$recursos = array();
		$nxm = SistemaNivelModuloQuery::create()->filterByIdSistemaNivel($usuario[0]->getIdSistemaNivel())->orderByPosicion()->find();
		foreach($nxm as $nm){
			//$nm = new SistemaNivelModulo();
			$recursos[$nm->getSistemaModulo()->getId()]['nombre'] = $nm->getSistemaModulo()->getEtiqueta();
			$recs = SistemaRecursoQuery::create()->filterBySistemaModulo($nm->getSistemaModulo())->orderByPosicion()->find();
			foreach($recs as $r){
				//$r = new SistemaRecurso();
				$recursos[$nm->getSistemaModulo()->getId()]['links'][] = array(
					'label'=>$r->getEtiqueta(),
					'url'=>'module='.$nm->getSistemaModulo()->getNombre().'&view='.$r->getNombre(),
					'visible'=>$r->getVisible()
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
$template = 'abmLogin.html';
$html = null;

$tmp = new SmartyTemplate();
$tmp->assign('titulo',$titulo);
$tmp->assign('descripcion',$descripcion);
$html = $tmp->fetch($template);
?>