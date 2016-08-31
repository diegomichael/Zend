<?php

class PratoController extends Blog_Controller_Action {

    public function indexAction() {
        $tab = new Application_Model_DbTable_Prato();
        $consulta = $tab->getAdapter()->select();
        $consulta->from(array(
            'p' => "pratos"
        ), array(
            "idpratos",
            "nomeprato",
            "precoprato"
        ));
        
        
        $consulta->joinInner(array("c" =>"categoria"), "c.idcategoria = p.idcategoria", array(
            "categoria"
        ));
        $consulta->where("p.idcategoria > ?", 0, Zend_Db::INT_TYPE);
        $consultaBd = $consulta->query()->fetchAll();
        $this->view->podeApagar = $this->aclIsAllowed('prato', 'delete');
        
        $this->view->pratos = $consultaBd;

    }

    public function createAction() {
        
        $podeEntrar = $this->aclIsAllowed('usuario', 'delete');
        
        if($podeEntrar){
            $frm = new Application_Form_PratoGerente();
        }else{
            $frm = new Application_Form_Prato();
        }
        
        if ($this->getRequest()->isPost()) {
            $params = $this->getAllParams();

            if ($frm->isValid($params)) {
                $params = $frm->getValues();

                $prato = new Application_Model_Vo_Prato();
                $prato->setPrato($params['prato']);
                $prato->setIdcategoria($params['idcategoria']);
                $prato->setPreco($params['preco']);

                $model = new Application_Model_Prato();
                $model->salvar($prato);

                $flashMessendge = $this->_helper->FlashMessenger;
                $flashMessendge->addMessage("Prato salvo");

                $this->_helper->Redirector->gotoSimpleAndExit('index');
            }
        }

        $this->view->frm = $frm;
    }

    public function deleteAction() {
        $idprato = (int)$this->getParam('idpratos', 0);
        $model = new Application_Model_Prato();
        $model->apagar($idprato);
        
        $flashMessenger = $this->_helper->FlashMessenger;
        $flashMessenger->addMessage('Registro apagado');
        
        $this->_helper->Redirector->gotoSimpleAndExit('index');
    }

    public function updateAction() {
        
                
        $idprato = (int)  $this->getParam('idpratos', 0);
        
        $tab = new Application_Model_DbTable_Prato();
        $row = $tab->fetchRow('idpratos = '.$idprato);
        
        if($row === null){
            echo "prato inexistente";
            exit;
        }
                
        $podeEntrar = $this->aclIsAllowed('usuario', 'delete');
        
        if($podeEntrar){
            $frm = new Application_Form_PratoGerente();
        }else{
            $frm = new Application_Form_Prato();
        }
        
        
        if($this->getRequest()->isPost()){
            $params = $this->getAllParams();
            
            if($frm->isValid($params)){
                $params = $frm->getValues();
                
                $prato = new Application_Model_Vo_Prato();
                $prato->setPrato($params['prato']);
                $prato->setPreco($params['precoprato']);
                $prato->setIdcategoria($params['idcategoria']);
                $prato->setIdprato($idprato);
                
                $model = new Application_Model_Prato();
                if($podeEntrar){
                    $model->atualizarGerente($prato);
                }else{
                    $model->atualizar($prato);
                }
                $flashMessendge =  $this->_helper->FlashMessenger;
                $flashMessendge->addMessage("O Prato foi salvo");
                
                $this->_helper->Redirector->gotoSimpleAndExit('index');
            }
        } else{
           // $frm->populate($row->toArray());
            $frm->populate(array(
                'prato' =>$row->nomeprato,
                'preco' =>$row->precoprato,
                'idcategoria' =>$row->idcategoria
            ));
        }
        
        $this->view->frm = $frm;
        
    }

}
