<?php
function permite_acceso($username=null,$status=null,&$auth=null)
{
    global $archivo_css,$este;
    $error=$status==-3?'Usuario o password incorrectos':'';
    $cuerpo=<<<html
<div>$error</div>
<div>
<form method="post" action="$este">
<input type="text" name="username" value="$username" />
<input type="password" name="password" />
<input type="submit" value="Ingresar" />
</form>
</div>
html;
    $pagina=new Pagina('Login',true);
    $pagina->agregarCss($archivo_css);
    $pagina->agregarBody($cuerpo);
    $html_pagina=$pagina->toHtml();
    echo $html_pagina;
}
?>
