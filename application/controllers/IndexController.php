<?php

class IndexController extends Blog_Controller_Action {

    public function indexAction() {
        
        $select = $this->select();        
        $selectCat = $this->selectCategoria();

        $selectCat->order('c.idcategoria desc');
        $selectCat->limit(10);
        
        
        $select->order("p.idpratos desc");
        $select->limit(10);
        
        $consultaCat = $selectCat->query()->fetchAll();
        $this->view->categorias = $consultaCat;
        
        $consulta = $select->query()->fetchAll();
        $this->view->pratos = $consulta;
   }

    public function categoriasAction() {
        
        $select = $this->selectCategoria();
        
        $categoria = $select->query()->fetchAll();
        
        $this->view->categorias = $categoria;
    }

    public function pratoAction() {
        $idprato = (int) $this->getParam('idpratos', 0);
        
        $select = $this->select();
        $select->where("p.idpratos = ?", $idprato);
        
        $prato = $select->query()->fetch();
        
        $this->view->pratos = $prato;
    }
    
    private function select() {
        $dbAdapter = Zend_Db_Table_Abstract::getDefaultAdapter();
        $select  = $dbAdapter->select();
        $select->from(array(
            'p' => 'pratos'
        ), array(
            'nomeprato',
            'precoprato',
            'idpratos'
        ));
        $select->joinInner(array(
            'c' => 'categoria'
        ), "p.idcategoria = c.idcategoria", array(
            'categoria'
        ));
        return $select;
    }
    
    private function selectCategoria() {
        $dbAdapter = Zend_Db_Table_Abstract::getDefaultAdapter();

        $select  = $dbAdapter->select();
        $select->from(array(
            'c' => 'categoria'
        ), array(
            'categoria',
            'idcategoria'
        ));
        return $select;
    }

}
