<?php

class Application_Model_Vo_Categoria {
    private $idcategoria;
    private $categoria;
    
    function getIdcategoria() {
        return $this->idcategoria;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function setIdcategoria($idcategoria) {
        $this->idcategoria = $idcategoria;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

}