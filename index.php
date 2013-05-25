<?php
require_once "construye.php";
$titulo='Home';

if($adentro)
{
    $cuerpo=<<<html
<div>$usuario</div>
<div><a href="$este?accion=salir">Salir</a></div>
<div>Hola mundo</div>
html;
    $pagina->agregarTitle($titulo);
    $pagina->agregarBody($cuerpo);
    $html_pagina=$pagina->toHtml();
    echo $html_pagina;
}
?>
