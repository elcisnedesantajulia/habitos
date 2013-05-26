<?php
require_once "var_auth.php";
require_once "var_globales.php";
require_once "Pagina.php";
require_once "Puerta.php";
require_once "Habitos.php";
require_once "Auth.php";

$dsn="mysql://$usuario_db:$passwd_db@$servidor_db/$nombre_db";
$puerta=new Puerta($dsn,$nombre_sesion);
$adentro=$puerta->abrir($usuario);
if($adentro)
{
    $pagina=new Pagina(null,true);
    $pagina->agregarCss($archivo_css);
}
?>
