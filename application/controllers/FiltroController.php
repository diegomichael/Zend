<?php

class FiltroController extends Zend_Controller_Action{
    public function digitsAction(){
        $filtro = new Zend_Filter_Digits();
        echo $filtro->filter(date('c'));
        exit;
    }
    
    public function htmlAction(){
        $filtro = new Zend_Filter_HtmlEntities();
        
        $var = "<strong>Brasil</strong>";
        
        echo $filtro->filter($var);
        exit;
    }
    
    public function stripAction(){
        $filtro = new Zend_Filter_StripTags();
        $var = "<strong>Brasil</strong>";
        
        echo $filtro->filter($var);
        exit();
        
    }
    
    public function compressAction(){
        $filtro = new Zend_Filter_Compress(array(
           'adapter' => 'Zip',
            'options' => array(
                'archive' =>'D:\\zend.zip'
            )
        ));
        $filtro->filter('C:\\install.ini');
        exit;
        
    }
}

