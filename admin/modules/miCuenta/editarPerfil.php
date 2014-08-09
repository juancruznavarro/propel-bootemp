<?php
// POST
if(!empty($_POST['action'])){
	$usuario = SistemaUsuarioQuery::create()->findPk($_SESSION['log']['usuario']->getId());
	if(!empty($_POST['clave']))
	$usuario->setPassword(md5($_POST['clave']));
	$usuario->save();
	//---
	header('Location: ?module='.$_POST['module'].'&view='.$_POST['view'].'&e=o');exit();
}

// GET
$titulo = 'Actualizar Perfil';
$template = 'miPerfilFrm.html';
$html = null;
$tmp = new SmartyTemplate();

$usuario = $_SESSION['log']['usuario'];
//$usuario = new SistemaUsuario();

$tmp->assign('nick',$usuario->getNick());
$tmp->assign('mensaje',$msj);
$tmp->assign('titulo',$titulo);
$tmp->assign('action','edit');
$html = $tmp->fetch($template);
?>