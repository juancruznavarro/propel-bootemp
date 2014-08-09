<?php
// POST
if(!empty($_POST['action'])){

	if($_POST['action']=='add')
	$us = new SistemaUsuario();
	else
	$us = SistemaUsuarioQuery::create()->findPk($_POST['id']);

	$us->setIdSistemaNivel($_POST['nivel']);
	$us->setNick($_POST['user']);
    $us->setFirstName($_POST['firstName']);
    $us->setLastName($_POST['lastName']);
	if (!empty($_POST['password']))
	    $us->setPassword(md5($_POST['password']));
	$us->setActivo($_POST['estado']);
	$us->save();

	// RECURSOS
	foreach($us->getSistemaUsuarioRecursos() as $ur){
		//$ur = new SistemaUsuarioRecurso();
		$ur->delete();
	}

	$nivel = SistemaNivelQuery::create()->findPk($_POST['nivel']);
	foreach($nivel->getSistemaModulos() as $m){
		//$m = new SistemaModulo();
		foreach($m->getSistemaRecursos() as $r){
			//$r = new SistemaRecurso();
			$us->addSistemaRecurso($r);
		}
	}
	$us->save();

	//----
	header('Location: ?module='.$_POST['module'].'&view='.$_POST['view'].'&action=edit&id='.$us->getId().'&return=1');
	exit;

}

// GET
$titulo = 'Users';
$descripcion = '';
$template = 'usuarioList.html';
$html = null;
$tmp = new SmartyTemplate();

switch($_GET['action']){
	case 'add':
		$titulo = 'Nuevo Usuario';
		$descripcion = '';
		$template = 'usuarioFrm.html';

		foreach (SistemaNivelQuery::create()->find() as $n){
			if ($n->getId()!='R')
			$niveles[] = array('id'=>$n->getId(),'nombre'=>$n->getNombre());
		}
		$tmp->assign('niveles',$niveles);
		$tmp->assign('estadoInactivo','checked="checked"');
		break;
	case 'edit':
		$titulo = 'Edición de Usuario';
		$descripcion = '';
		$template = 'usuarioFrm.html';

		$us = SistemaUsuarioQuery::create()->findPk($_GET['id']);

        $tmp->assign('id',$us->getId());
        $tmp->assign('nick',$us->getNick());
        $tmp->assign('lastName',$us->getLastName());
        $tmp->assign('firstName',$us->getFirstName());

		foreach (SistemaNivelQuery::create()->find() as $n){
			if ($n->getId()!='R')
			$niveles[] = array('id'=>$n->getId(),'nombre'=>$n->getNombre(),'selected'=>($n->getId()==$us->getIdSistemaNivel())?' selected="selected" ':null);
		}
		$tmp->assign('niveles',$niveles);
		if($us->getActivo()=='Y')
		$tmp->assign('estadoActivo','checked="checked"');
		else
		$tmp->assign('estadoInactivo','checked="checked"');

		break;
	case 'del':
		$us = SistemaUsuarioQuery::create()->filterById($_GET['id'])->delete();
		header('Location: ?module='.$_GET['module'].'&view='.$_GET['view'].'&e=o');
		exit;

		break;
	case 'editEstadoHab':
		$us = SistemaUsuarioQuery::create()->findPk($_GET['id']);
		$us->setActivo('Y');
		$us->save();
		header('Location: ?module='.$_GET['module'].'&view='.$_GET['view'].'&e=o');
		exit;

		break;
	case 'editEstadoNoHab':
		$us = SistemaUsuarioQuery::create()->findPk($_GET['id']);
		$us->setActivo('N');
		$us->save();
		header('Location: ?module='.$_GET['module'].'&view='.$_GET['view'].'&e=o');
		exit;

		break;
	default:
    $q = SistemaUsuarioQuery::create()->filterByIdSistemaNivel('R',Criteria::ALT_NOT_EQUAL)->orderById(Criteria::DESC)->find();

	$i = 1;
	foreach($q as $n){
		$usuarios[] = array(
            'id'=>$n->getId(),
            'numero'=>$i+$desde,
            'usuario'=>$n->getNick(),
            'nombre' => $n->getFirstName(),
            'apellido' => $n->getLastName(),
            'nivel'=>$n->getSistemaNivel()->getNombre(),
            'estado'=>$n->getActivo()
		);
		$i++;
	}
	$tmp->assign('usuarios',$usuarios);

	$tmp->assign('paginado',$paginado);
}


$tmp->assign('titulo',$titulo);
$tmp->assign('descripcion',$descripcion);
$html = $tmp->fetch($template);
?>