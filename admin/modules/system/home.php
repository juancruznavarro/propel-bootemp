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

    $recursos = array();
    $rec = SistemaRecursoQuery::create()->filterByIco(null, Criteria::NOT_EQUAL)->filterByVisible('Y')->find();
    foreach ($rec as $r) {
        //$r= new SistemaRecurso();
        $recursos[] = array(
            'nombre' => $r->getNombre(),
            'etiqueta' => $r->getEtiqueta(),
            'ico' => $r->getIco(),
            'url' => 'module='.$r->getSistemaModulo()->getNombre().'&view='.$r->getNombre()

        );
    }

    $tmp->assign('recursos', $recursos);




$tmp->assign('titulo',$titulo);
$tmp->assign('descripcion',$descripcion);
$html = $tmp->fetch($template);
?>
