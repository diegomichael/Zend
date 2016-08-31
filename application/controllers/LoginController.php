<?php

class LoginController extends Blog_Controller_Action {

    public function indexAction() {
        $form = new Application_Form_Login();
        
        if ($this->getRequest()->isPost()) {
            $values = $this->getAllParams();
            if ($form->isValid($values)) {
                // autenticacao do usuario
                $adapter = new Zend_Auth_Adapter_DbTable();
                $adapter->setTableName('admin');
                $adapter->setIdentityColumn('email');
                $adapter->setCredentialColumn('senha');
                
                $adapter->setIdentity($form->getValue('email'));
                $adapter->setCredential($form->getValue('senha'));
                
                $auth = Zend_Auth::getInstance();
                
                $resultado = $auth->authenticate($adapter);
                
                if ($resultado->isValid()){
                  $dados = $adapter->getResultRowObject(null, array('senha'));
                  $auth->getStorage()->write($dados);
                  $this->_helper->redirector->gotoSimpleAndExit('index','index');
                  
                }else{
                    $form->getElement('email')->addError('Login e/ou Senha incorretos');
                }
            }
        }
        
        $this->view->form = $form;
    }

    public function logoutAction() {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->redirector->gotoSimpleAndExit('index');
        
    }

}
