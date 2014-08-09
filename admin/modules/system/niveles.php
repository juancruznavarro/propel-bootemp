<?php
// POST
if(!empty($_POST['action'])){
	switch($_POST['action']){
		case 'add':
			$nivel = new SistemaNivel();
			$nivel->setId($_POST['idNew']);
			$nivel->setDescripcion($_POST['desc']);
			$nivel->setHome($_POST['home']);
			$nivel->setNombre($_POST['nombre']);
			$nivel->save();
				
			header('Location: ?module='.$_POST['module'].'&view='.$_POST['view'].'&action=edit&id='.$nivel->getId());exit();
			break;
		case 'edit':
			$nivel = SistemaNivelQuery::create()->findPk($_POST['id']);
			$nivel->setDescripcion($_POST['desc']);
			$nivel->setHome($_POST['home']);
			$nivel->setNombre($_POST['nombre']);
			$nivel->save();
				
			header('Location: ?module='.$_POST['module'].'&view='.$_POST['view'].'&action=edit&id='.$nivel->getId());exit();
			break;
		case 'habilitar':
			foreach($_POST['idModulo'] as $idMod){
				$nm = new SistemaNivelModulo();
				$nm->setIdSistemaModulo($idMod);
				$nm->setIdSistemaNivel($_POST['id']);
				$nm->setPosicion($_POST['posicion_'.$idMod]);
				$nm->save();
			}
			header('Location: ?module='.$_POST['module'].'&view='.$_POST['view'].'&action=edit&id='.$_POST['id']);exit();
			break;
		case 'ordenar':
			foreach($_POST['idModulo'] as $idMod){
				$mod = SistemaNivelModuloQuery::create()->filterByIdSistemaNivel($_POST['id'])->filterByIdSistemaModulo($idMod)->findOne();
				$mod->setPosicion($_POST['posicion_'.$idMod]);
				$mod->save();
			}
			header('Location: ?module='.$_POST['module'].'&view='.$_POST['view'].'&action=edit&id='.$_POST['id']);exit();
			break;
	}
}

// GET
$titulo = 'Niveles de Acceso';
$template = 'nivelList.html';
$html = null;
$tmp = new SmartyTemplate();

switch($_GET['action']){
	case 'add':
		$titulo = 'Nuevo Nivel de Acceso';
		$template = 'nivelFrm.html';

		$tmp->assign('action','add');
		break;
	case 'edit':
		$titulo = 'Edición de Nivel de Acceso';
		$template = 'nivelFrm.html';
		$nivel = SistemaNivelQuery::create()->findPk($_GET['id']);

		$modulosHabilitados = array();
		$idMods = array();
		foreach(SistemaNivelModuloQuery::create()->filterBySistemaNivel($nivel)->orderByPosicion()->find() as $m){
			//$m = new SistemaNivelModulo();
			$modulosHabilitados[] = array(
				'posicion'=>$m->getPosicion(),
				'nombre'=>$m->getSistemaModulo()->getNombre(),
				'descripcion'=>$m->getSistemaModulo()->getDescripcion(),
				'id'=>$m->getIdSistemaModulo()
			);
			$idMods[] = $m->getIdSistemaModulo();
		}

		$modulosInhabilitados = array();
		$i = count($modulosHabilitados)+1;

		$qry = SistemaModuloQuery::create();
		$qry->filterById($idMods, Criteria::NOT_IN);
		foreach($qry->find() as $m){
			//$m = new SistemaModulo();
			$modulosInhabilitados[] = array(
				'posicion'=>$i,
				'nombre'=>$m->getNombre(),
				'descripcion'=>$m->getDescripcion(),
				'id'=>$m->getId()
			);
			$i++;
		}

		$tmp->assign('id',$nivel->getId());
		$tmp->assign('modulosHabilitados',$modulosHabilitados);
		$tmp->assign('modulosInhabilitados',$modulosInhabilitados);
		$tmp->assign('nombre',$nivel->getNombre());
		$tmp->assign('desc',$nivel->getDescripcion());
		$tmp->assign('home',$nivel->getHome());
		break;
	case 'del':
		$nivel = SistemaNivelQuery::create()->findPk($_GET['id']);
		$nivel->delete();
		//---
		header('Location: ?module='.$_GET['module'].'&view='.$_GET['view'].'&e=o');exit();
		break;
	case 'delModulo':
		$nm = SistemaNivelModuloQuery::create()->findPk(array($_GET['id'],$_GET['idMod']));
		$nm->delete();
		//---
		header('Location: ?module='.$_GET['module'].'&view='.$_GET['view'].'&action=edit&id='.$_GET['id'].'&e=o');exit();
		break;
	default:
		$niveles = array();
	$i = 1;
	foreach(SistemaNivelQuery::create()->find() as $n){
		//$n = new SistemaNivel();
		$modulos = array();
		foreach($n->getSistemaModulos() as $m){
			$modulos[] = $m->getEtiqueta();
		}
			
		$niveles[] = array(
				'numero'=>$i,
				'descripcion'=>$n->getDescripcion(),
				'home'=>$n->getHome(),
				'id'=>$n->getId(),
				'nombre'=>$n->getNombre(),
				'modulos'=>implode('<br />', $modulos)
		);
		$i++;
	}

	$tmp->assign('niveles',$niveles);
	break;
}

$tmp->assign('mensaje',$msj);
$tmp->assign('titulo',$titulo);
$tmp->assign('descripcion',$descripcion);
$html = $tmp->fetch($template);
?>