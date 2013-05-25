<?php
class Pagina
{
    private $head;
    private $body;
    private $nice;

    function __construct($nice=false)
    {
        $this->head="<head><title>Titulo</title><head>";
        $this->body="<body></body>";
        $this->nice=$nice;
    }
    
    
}
?>
