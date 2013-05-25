<?php
require_once "var_auth.php";
require_once "var_globales.php";
require_once "Pagina.php";
require_once "Puerta.php";
require_once "Auth.php";

$dsn="mysql://$usuario_db:$passwd_db@$servidor_db/$nombre_db";
$puerta=new Puerta($dsn,$nombre_sesion);
$adentro=$puerta->abrir();

if($adentro)
{
    $usuario=$puerta->getUsername();
    $cuerpo=<<<html
<div>$usuario</div>
<div><a href="$este?accion=salir">Salir</a></div>
<div>Hola mundo</div>
html;
    $pagina=new Pagina('Titulo',true);
    $pagina->agregarCss($archivo_css);
    $pagina->agregarBody($cuerpo);
    $html_pagina=$pagina->toHtml();
    echo $html_pagina;
}
?>
