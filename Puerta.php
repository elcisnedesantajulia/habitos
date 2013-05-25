<?php
class Puerta
{
    private $_a;
    
    function __construct($dsn,$nombre_sesion,$login=true)
    {
        $opciones_auth=array('dsn'=>$dsn);
        $arr_callback=array($this,"permite_acceso");
        $this->_a=new Auth('DB',$opciones_auth,$arr_callback,$login);
        $this->_a->setSessionName($nombre_sesion);
    }

    public function abrir()
    {
        $this->_a->start();
        if($_GET['accion'] == 'salir' && $this->_a->checkAuth())
        {
            $this->_a->logout();
            $this->_a->start();
        }
        if($this->_a->checkAuth())
        {
            return true;
        }
        return false;
    }

    public function getUsername()
    {
        return $this->_a->getUsername();
    }
    
    public function permite_acceso($username=null,$status=null,&$auth=null)
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
}
?>
