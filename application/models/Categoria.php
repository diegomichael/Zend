<?php

class Application_Model_Categoria {

    public function apagar($idcategoria) {
        $tabpost = new Application_Model_DbTable_Prato();
        $post = $tabpost->fetchRow("idcategoria = $idcategoria");
        
        if($post !== null){
            throw new Exception("Categoria com Prato", 1); 
           
        }
        $tab = new Application_Model_DbTable_Categoria();
        $tab->delete("idcategoria = $idcategoria");
        
        return true;
    }

    public function atualizar(Application_Model_Vo_Categoria $categoria) {
        $tab = new Application_Model_DbTable_Categoria();
        $tab->update(array(
           'categoria' => $categoria->getCategoria() 
        ), 'idcategoria = '.$categoria->getIdcategoria());
        
        return true;
    }

    public function salvar(Application_Model_Vo_Categoria $categoria) {
        $tab = new Application_Model_DbTable_Categoria();
        $tab->insert(array(
           'categoria' => $categoria->getCategoria() 
        ));
        
       $id = $tab->getAdapter()->lastInsertId();
       $categoria->setIdcategoria($id);
       return true;
    }

}
