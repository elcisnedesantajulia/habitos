<?php
require_once "var_auth.php";
require_once "var_globales.php";
require_once "funciones_varias.php";
require_once "Pagina.php";
require_once "Auth.php";

$opciones_auth=array('dsn'=>"mysql://$usuario_db:$passwd_db@$servidor_db/$nombre_db");
$a = new Auth('DB',$opciones_auth,"permite_acceso");
$a->setSessionName($nombre_sesion);
$a->start();

if($_GET['accion'] == "salir" && $a->checkAuth())
{
    $a->logout();
    $a->start();
}
if ($a->checkAuth())
{
    $autenticado=true;
    $usuario=$a->getUsername();
}

if($autenticado)
{
    $cuerpo=<<<html
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
