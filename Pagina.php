<?php
class Pagina
{
    private $_titulo;
    private $_cuerpo;
    private $_hr; //human readable
    private $_arr_archivos_css=array();

    function __construct($titulo='',$hr=false)
    {
        $this->_titulo=$titulo;
        $this->_hr=$hr;
    }
    
    public function toHtml()
    {
        $head=$this->head();
        $body=$this->body();
        $html=<<<html
<!DOCTYPE html>
<html>
$head
$body
</html>
html;
        //TODO aqui hacer arreglos a html antes de enviar
        if($this->_hr==false)
        {
            $html=str_replace("\n",'',$html);
        }
        return $html;

    }

    public function agregarBody($cuerpo)
    {
        $this->_cuerpo=$cuerpo;
    }

    public function agregarTitle($titulo)
    {
        $this->_titulo=$titulo;
    }

    public function agregarCss($nombre)
    {
        $this->_arr_archivos_css[]=$nombre;
    }

    private function head()
    {
        $titulo=$this->_titulo;
        $html_css='';
        foreach($this->_arr_archivos_css as $valor)
        {
            $html_css.=<<<html
<link rel="stylesheet" type="text/css" href="$valor" />
html;
        }
        return <<<html
<head>
<title>$titulo</title>
$html_css
</head>
html;
    }

    private function body()
    {
        $cuerpo=$this->_cuerpo;
        return <<<html
<body>
$cuerpo
</body>
html;
    }
}
?>
