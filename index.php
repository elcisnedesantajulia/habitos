<?php
require_once "construye.php";
$titulo='Home';

if($adentro)
{
    $habitos=new Habitos($usuario);
    if(is_numeric($_GET["s"]))
    {
        $id_cumplimiento=$_GET["s"];
        $habitos->cumple($id_cumplimiento);
    }
    if(is_numeric($_GET["n"]))
    {
        $id_cumplimiento=$_GET["n"];
        $habitos->cumple($id_cumplimiento,0);
    }
    if($arr_vencidos=$habitos->obtieneVencidos())
    {
        $vencidos="<div>\n";
        foreach($arr_vencidos as $este_vencido)
        {
            $id_cumplimiento=$este_vencido["id_cumplimiento"];
            $dia            =$este_vencido["dia"];
            $habito         =$este_vencido["habito"];
            $descripcion    =$este_vencido["descripcion"];
            $link_si="<a href=\"$este?s=$id_cumplimiento\">SI</a>";
            $link_no="<a href=\"$este?n=$id_cumplimiento\">NO</a>";
            $vencidos.=<<<html
<p>$dia <span title="$descripcion">$habito</span>: $link_si $link_no</p>
html;
        }
        $vencidos.="</div>\n";
    }
    else
    {
        $vencidos="<div>Felicidades, estas al d&iacute;a</div>\n";
    }
    if($arr_estadisticas=$habitos->estadisticas())
    {
        $tabla_estadisticas="<table>\n<tr><th>Dia</th><th>Promedio</th><th>Eventos</th></tr>\n";
        foreach($arr_estadisticas as $esta_fila)
        {
            $dia        =$esta_fila["dia"];
            $promedio   =$esta_fila["promedio"];
            $total      =$esta_fila["total"];
            $tabla_estadisticas.="<tr><td>$dia</td><td>$promedio</td><td>$total</td></tr>\n";
        }
        $tabla_estadisticas.="</table>\n";
    }
    $cuerpo=<<<html
<div id="contenedor">
<div id="info_usuario">$usuario | <a href="$este?accion=salir">Salir</a></div>
<hr />
$vencidos
$tabla_estadisticas
</div>
html;
    $pagina->agregarTitle($titulo);
    $pagina->agregarBody($cuerpo);
    $html_pagina=$pagina->toHtml();
    echo $html_pagina;
}
?>
