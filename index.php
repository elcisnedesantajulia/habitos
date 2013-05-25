<?php
require_once "Pagina.php";

$cuerpo=<<<html
Hola mundo
html;
$pagina=new Pagina('Titulo',true);
$pagina->agregarCss('estilo.css');
$pagina->agregarBody($cuerpo);
$html_pagina=$pagina->toHtml();
echo $html_pagina;
?>
