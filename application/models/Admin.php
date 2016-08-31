<?php

class Application_Model_Admin {

    public function apagar($idcategoria) {
        throw new Application_Model_Exception('O usuário não pode ser apagado do sistema');
    }

    public function atualizar(Application_Model_Vo_Admin $admin) {
        $tb = new Application_Model_DbTable_Admin();

        $tb->update(array(
            'nome' => $admin->getNome(),
            'email' => $admin->getEmail(),
            'senha' => $admin->getSenha(),
            'papel' => $admin->getPapel(),
                ), 'idadmin = ' . $admin->getIdadmin());
    }

    public function salvar(Application_Model_Vo_Admin $admin) {
        $tb = new Application_Model_DbTable_Admin();

        $tb->insert(array(
            'nome' => $admin->getNome(),
            'email' => $admin->getEmail(),
            'senha' => $admin->getSenha(),
            'papel' => $admin->getPapel(),
        ));

        $admin->setIdadmin($tb->getAdapter()->lastInsertId());
    }

}
