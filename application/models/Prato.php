<?php

    class Application_Model_Prato {
        
        public function apagar($idprato){
            $tab = new Application_Model_DbTable_Prato();
            $tab->delete("idpratos = $idprato");
            
            return true;
        }
        public function atualizar(Application_Model_Vo_Prato $prato){
            $tab = new Application_Model_DbTable_Prato();
            $tab->update(array(
                'idcategoria' => $prato->getIdcategoria(),
                'nomeprato' => $prato->getPrato()
            ), 'idpratos = '. $prato->getIdprato());
            
            return true;
        }
        public function atualizarGerente(Application_Model_Vo_Prato $prato){
            $tab = new Application_Model_DbTable_Prato();
            $tab->update(array(
                'idcategoria' => $prato->getIdcategoria(),
                'nomeprato' => $prato->getPrato(),
                'precoprato' => $prato->getPreco(),
            ), 'idprato= '.$prato->getIdprato());
            
            return true;
        }

        public function salvar(Application_Model_Vo_Prato $prato){
            $tab = new Application_Model_DbTable_Prato();
            $tab->insert(array(
                'idcategoria' => $prato->getIdcategoria(),
                'nomeprato' => $prato->getPrato(),
                'precoprato' => $prato->getPreco()
            ));

          $id = $tab->getAdapter()->lastInsertId();
          $prato->setIdprato($id);
          return true;
        }
    }
