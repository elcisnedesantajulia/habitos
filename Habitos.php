<?php
class Habitos
{
    private $_username;
    private $_mysqli;

    function __construct($username)
    {
        global $usuario_db,$passwd_db,$servidor_db,$nombre_db;
        $this->_username=$username;
        $this->_mysqli=new mysqli($servido_db,$usuario_db,$passwd_db,$nombre_db);
    }

    public function obtieneVencidos()
    {
        $username=$this->_username;
        $consulta=<<<sql
SELECT id_cumplimiento,id_habito,dia,habito,descripcion
FROM cumplimientos
INNER JOIN habitos USING(id_habito)
WHERE dia<=NOW()
AND visible
AND username='$username'
AND cumplido IS NULL
sql;
        if($res=$this->_mysqli->query($consulta))
        {
            while($esta_fila=$res->fetch_assoc())
            {
                $arr_vencidos[]=$esta_fila;
            }
            if(count($arr_vencidos))
            {
                return $arr_vencidos;
            }
        }
        return false;
    }

    public function creaCumplimientos()
    {
        global $dias_cache;
        if($arr_habitos=$this->obtieneHabitos())
        {
            foreach($arr_habitos as $este_habito)
            {
                $epoch=time();
                $id_habito=$este_habito["id_habito"];
                for($i=0;$i<$dias_cache;$i++)
                {
                    $consulta=<<<sql
INSERT IGNORE INTO cumplimientos
(ctime,dia,id_habito)
VALUES
(NOW(),FROM_UNIXTIME($epoch,'%Y-%m-%d'),$id_habito)
sql;
                    $this->_mysqli->query($consulta);
                    $epoch+=24*60*60;
                }
            }
        }
    }

    public function obtieneHabitos()
    {
        $username=$this->_username;
        $consulta=<<<sql
SELECT id_habito,ctime,habito,descripcion
FROM habitos
WHERE username='$username'
AND visible
sql;
        if($res=$this->_mysqli->query($consulta))
        {
            while($esta_fila=$res->fetch_assoc())
            {
                $arr_habitos[]=$esta_fila;
            }
            if(count($arr_habitos))
            {
                return $arr_habitos;
            }
        }
        return false;
    }
}
?>
