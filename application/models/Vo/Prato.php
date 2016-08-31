<?php

    class Application_Model_Vo_Prato {
        
        private $idprato;
        private $idcategoria;
        private $prato;
        private $preco;
        
        function getIdprato(){
            return $this->idprato;
        }
        
        function getIdcategoria(){
            return $this->idcategoria;
        }
        
        function getPrato(){
            return $this->prato;
        }
        
        function getPreco(){
            return $this->preco;
        }
        
        function setIdprato($idprato){
            $this->idprato = $idprato;
        }
        
        function setIdcategoria($idcategoria){
            $this->idcategoria = $idcategoria;
        }
        
        function setPrato($prato){
            $this->prato = $prato;
        }
        
        function setPreco($preco){
            $this->preco = $preco;
        }
    }
