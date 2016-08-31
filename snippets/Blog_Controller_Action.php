<?php

class Blog_Controller_Action extends Zend_Controller_Action {

    public function init() {
        $session = Zend_Registry::get('session');
        //verifica ACL
        if (Zend_Registry::isRegistered('acl')) {
            $request = $this->getRequest();
            //pega o nome do modulo, controlador e action
            $controller = $request->getControllerName();
            $action = $request->getActionName();

            //monta o nome do resource e do privilege. exemplo: default_index
            $resource = $controller;
            $privilege = $action;

            $role = $this->getAuthRole();

            //faz a verificação da permissão
            $acl = Zend_Registry::get('acl');
            if (!$acl->isAllowed($role, $resource, $privilege)) {
                die("Você não tem permissão para executar a tarefa ({$role})");
                // $session->erro = 'ACL inválida';
                // $this->_redirect('/login');
            }

            Zend_Layout::getMvcInstance()
                    ->getView()
                    ->navigation()
                    ->setAcl($acl)
                    ->setRole($role);
        }
    }

    /**
     * 
     * @return Zend_Acl
     */
    protected function getAcl() {
        return Zend_Registry::get('acl');
    }

    protected function getAuthRole() {
        $auth = Zend_Auth::getInstance();
        //se o usuário fez login usa a role que está na sessão
        if ($auth->hasIdentity()) {
            $role = ($auth->getIdentity()->papel == '2') ? 'admin' : 'redator';
        } else {
            $role = 'visitante';
        }
        return $role;
    }
    
    protected function aclIsAllowed($resource, $privilege) {
        return $this->getAcl()->isAllowed($this->getAuthRole(), $resource, $privilege);
    }

}
