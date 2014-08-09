<?php
// POST
if(!empty($_POST['action'])){

}

// GET
$titulo = 'Sistema de Gestión';
$descripcion = '';
$template = 'home.html';
$html = null;



$tmp = new SmartyTemplate();
$tmp->assign('titulo',$titulo);
$tmp->assign('descripcion',$descripcion);
$html = $tmp->fetch($template);
?>
