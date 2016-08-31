<?php

class CategoriaController extends Blog_Controller_Action {

    public function indexAction() {
        $tab = new Application_Model_DbTable_Categoria();
        $categorias = $tab->fetchAll(null, 'idcategoria desc');
        $this->view->categorias = $categorias;
    }

    public function createAction() {
        $frm = new Application_Form_Categoria();
        
        if($this->getRequest()->isPost()){
            $params = $this->getAllParams();
            
            if($frm->isValid($params)){
                $params = $frm->getValues();
                
                $categoria = new Application_Model_Vo_Categoria();
                $categoria->setCategoria($params['categoria']);
                
                $model = new Application_Model_Categoria();
                $model->salvar($categoria);
                
                $flashMessendge =  $this->_helper->FlashMessenger;
                $flashMessendge->addMessage("A categoria foi salva");
                
                $this->_helper->Redirector->gotoSimpleAndExit('index');
            }
        }
        
        $this->view->frm = $frm;
    }

    public function deleteAction() {
        $idcategoria = (int)$this->getParam('idcategoria', 0);
        $model = new Application_Model_Categoria();
        $flashMessenger = $this->_helper->FlashMessenger;
        
        try {
            $model->apagar($idcategoria);
            $flashMessenger->addMessage('Registro apagado');
        } catch (Exception $ex) {
            $flashMessenger->addMessage($ex->getMessage());
        } 
        
        
        
        
        
        $this->_helper->Redirector->gotoSimpleAndExit('index');
    }

    public function updateAction() {
        
        $idcategoria = (int)  $this->getParam('idcategoria', 0);
        
        $tab = new Application_Model_DbTable_Categoria();
        $row = $tab->fetchRow('idcategoria = '.$idcategoria);
        
        if($row === null){
            echo "categoria inexistente";
            exit;
        }
        
        $frm = new Application_Form_Categoria();
        
        if($this->getRequest()->isPost()){
            $params = $this->getAllParams();
            
            if($frm->isValid($params)){
                $params = $frm->getValues();
                
                $categoria = new Application_Model_Vo_Categoria();
                $categoria->setCategoria($params['categoria']);
                $categoria->setIdcategoria($idcategoria);
                
                $model = new Application_Model_Categoria();
                $model->atualizar($categoria);
                
                $flashMessendge =  $this->_helper->FlashMessenger;
                $flashMessendge->addMessage("A categoria foi salva");
                
                $this->_helper->Redirector->gotoSimpleAndExit('index');
            }
        } else{
            $frm->populate(array(
                'categoria' =>$row->categoria
            ));
        }
        
        $this->view->frm = $frm;
        
    }

}
