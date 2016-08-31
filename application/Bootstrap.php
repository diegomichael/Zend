<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    public function _initLoader() {
        $loader = Zend_Loader_Autoloader::getInstance();
        $loader->registerNamespace('Blog_');
    }

    public function _initSession() {
        $session = new Zend_Session_Namespace('Blog');
        Zend_Registry::set('session', $session);
    }

    public function _initConfig() {
        $config = new Zend_Config($this->getApplication()->getOptions(), true);
        Zend_Registry::set('config', $config);
    }
    
    // _initNavigation
    protected function _initNavigation() {
        $this->bootstrap('layout');

        $xml = APPLICATION_PATH . '/configs/navigation.xml';
        $config = new Zend_Config_Xml($xml, 'nav');
        $container = new Zend_Navigation($config);

        $layout = $this->getResource('layout');
        $view = $layout->getView();
        $view->navigation($container);

        Zend_Registry::set('Zend_Navigation', $container);
    }
    // _initAcl
    protected function _initAcl() {
        $acl = new Zend_Acl;
        $config = Zend_Registry::get('config');

        foreach ($config->acl->roles as $role => $parent) {
            if ($parent) {
                $acl->addRole(new Zend_Acl_Role($role), $parent);
            } else {
                $acl->addRole(new Zend_Acl_Role($role));
            }
        }
        foreach ($config->acl->resources as $r) {
            $acl->add(new Zend_Acl_Resource($r));
        }
        if (isset($config->acl->allow)) {
            foreach ($config->acl->allow as $role => $privilege) {
                foreach ($privilege as $p) {
                    $privilege = explode('.', $p);
                    $acl->allow($role, $privilege[0], $privilege[1]);
                }
            }
        }
        if (isset($config->acl->deny)) {
            foreach ($config->acl->deny as $role => $privilege) {
                foreach ($privilege as $p) {
                    $privilege = explode('.', $p);
                    $acl->deny($role, $privilege[0], $privilege[1]);
                }
            }
        }
        Zend_Registry::set('acl', $acl);
    }


    protected function _initDoctype() {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('HTML5');
    }

}
