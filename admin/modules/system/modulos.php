<?php
// POST
if(!empty($_POST['action'])){
	switch($_POST['action']){
		case 'edit':
			$mod = SistemaModuloQuery::create()->findPk($_POST['id']);
			$mod->setDescripcion($_POST['desc']);
			$mod->setEtiqueta($_POST['etiqueta']);
			$mod->save();
				
			foreach($_POST['idRecurso'] as $idRec){
				$rec = SistemaRecursoQuery::create()->findPk($idRec);
				$rec->setEtiqueta($_POST['etiqueta_'.$idRec]);
				$rec->setNombre($_POST['nombre_'.$idRec]);
				$rec->setPosicion($_POST['posicion_'.$idRec]);
				$rec->setVisible($_POST['visible_'.$idRec]);
				$rec->setIdSistemaModulo($_POST['id']);
				$rec->save();
			}
			header('Location: ?module='.$_POST['module'].'&view='.$_POST['view'].'&action=edit&id='.$mod->getId().'&e=o');exit();
			break;
		case 'addRecursos':
			foreach ($_POST['idRecurso'] as $idRec){
				$rec = new SistemaRecurso();
				$rec->setEtiqueta($_POST['etiqueta_'.$idRec]);
				$rec->setIdSistemaModulo($_POST['id']);
				$rec->setNombre($_POST['nombre_'.$idRec]);
				$rec->setPosicion($_POST['posicion_'.$idRec]);
				$rec->setVisible($_POST['visible_'.$idRec]);
				$rec->save();
			}
			header('Location: ?module='.$_POST['module'].'&view='.$_POST['view'].'&action=edit&id='.$_POST['id'].'&e=o');exit();
			break;
	}
}

// GET
$titulo = 'Listado de Módulos';
$template = 'moduloList.html';
$html = null;
$tmp = new SmartyTemplate();

switch($_GET['action']){
	case 'add':
		$mod = SistemaModuloQuery::getSistemaModuloSinInstalarByNombre($_GET['id']);
		$mod->save();
		//---
		header('Location: ?module='.$_GET['module'].'&view='.$_GET['view'].'&e=o');exit();
		break;
	case 'edit':
		$titulo = 'Edición de Módulo';
		$template = 'moduloFrm.html';

		$modulo = SistemaModuloQuery::create()->findPk($_GET['id']);
		$recursos = array();

		foreach (SistemaRecursoQuery::create()->filterBySistemaModulo($modulo)->orderByPosicion()->find() as $r){
			//$r = new SistemaRecurso();
			$recursos[] = array(
				'posicion'=>$r->getPosicion(),
				'nombre'=>$r->getNombre(),
				'etiqueta'=>$r->getEtiqueta(),
				'id'=>$r->getId(),
				'visibleY'=>($r->getVisible()=='Y')?' checked="checked"':null,
				'visibleN'=>($r->getVisible()=='N')?' checked="checked"':null
			);
		}

		$recursosNuevos = array();
		$i = count($recursos)+1;
		foreach($modulo->getSistemaRecursosNoInstalados() as $r){
			$recursosNuevos[] = array(
				'posicion'=>$i,
				'nombre'=>$r->getNombre(),
				'etiqueta'=>$r->getEtiqueta(),
				'id'=>$r->getNombre(),
				'visibleY'=>($r->getVisible()=='Y')?' checked="checked"':null,
				'visibleN'=>($r->getVisible()=='N')?' checked="checked"':null
			);
		}

		$tmp->assign('recursos',$recursos);
		$tmp->assign('id',$modulo->getId());
		$tmp->assign('recursosNuevos',$recursosNuevos);
		$tmp->assign('nombre',$modulo->getNombre());
		$tmp->assign('etiqueta',$modulo->getEtiqueta());
		$tmp->assign('desc',$modulo->getDescripcion());
		$tmp->assign('action','edit');
		break;
	case 'del':
		break;
	default:
		$modulosInstalados = array();
	$i = 1;
	foreach(SistemaModuloQuery::create()->find() as $m){
		//$m = new SistemaModulo();
		$modulosInstalados[] = array(
				'numero'=>$i,
				'nombre'=>$m->getNombre(),
				'etiqueta'=>$m->getEtiqueta(),
				'recursos'=>$m->getSistemaRecursos()->count(),
				'descripcion'=>$m->getDescripcion(),
				'id'=>$m->getId()
		);
		$i++;
	}

	$modulosSinInstalar = array();
	$i = 1;
	foreach(SistemaModuloQuery::getSistemaModuloSinInstalar() as $m){
		//$m = new SistemaModulo();
		$modulosSinInstalar[] = array(
				'numero'=>$i,
				'nombre'=>$m->getNombre(),
				'etiqueta'=>$m->getEtiqueta(),
				'recursos'=>$m->getSistemaRecursos()->count(),
				'descripcion'=>$m->getDescripcion(),
				'id'=>$m->getNombre()
		);
		$i++;
	}

	$tmp->assign('modulosInstalados',$modulosInstalados);
	$tmp->assign('modulosSinInstalar',$modulosSinInstalar);
	break;
}

$tmp->assign('mensaje',$msj);
$tmp->assign('titulo',$titulo);
$tmp->assign('descripcion',$descripcion);
$html = $tmp->fetch($template);
?>