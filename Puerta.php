<?php
class Puerta
{
    private $_a;
    
    function __construct($dsn,$nombre_sesion,$login=true)
    {
        $opciones_auth=array('dsn'=>$dsn);
        $arr_callback=array($this,'chapa');
        $arr_login_callback=array($this,'cuentaVisitas');
        $this->_a=new Auth('DB',$opciones_auth,$arr_callback,$login);
        $this->_a->setSessionName($nombre_sesion);
        $this->_a->setLoginCallback($arr_login_callback);
    }

    public function abrir(&$username=null)
    {
        $this->_a->start();
        if($_GET['accion'] == 'salir' && $this->_a->checkAuth())
        {
            $this->_a->logout();
            $this->_a->start();
        }
        if($this->_a->checkAuth())
        {
            $username=$this->_a->getUsername();
            return true;
        }
        return false;
    }

    public function getUsername()
    {
        return $this->_a->getUsername();
    }
    
    public function chapa($username=null,$status=null,&$auth=null)
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

    public function cuentaVisitas($username,&$auth=null)
    {
        global $usuario_db,$passwd_db,$servidor_db,$nombre_db;
        $mysqli=new mysqli($servido_db,$usuario_db,$passwd_db,$nombre_db);
        $consulta=<<<sql
UPDATE auth
SET n_visitas=n_visitas+1
WHERE username='$username'
sql;
        $mysqli->query($consulta);
        $consulta=<<<sql
INSERT INTO visitas
(ctime,username)
VALUES
(NOW(),'$username')
sql;
    }
}
?>
