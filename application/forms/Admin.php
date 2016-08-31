<?php

class Application_Form_Admin extends Zend_Form {

    private $emailNaoRepetidoVal;

    public function init() {
        $this->setMethod('post');

        $idadmin = new Zend_Form_Element_Hidden('idadmin');
        $this->addElement($idadmin);
        
        $nome = new Zend_Form_Element_Text('nome', array(
            'label' => 'Nome completo',
            'required' => true,
        ));
        $this->addElement($nome);

        $this->emailNaoRepetidoVal = new Zend_Validate_Db_NoRecordExists(array(
            'table' => 'admin',
            'field' => 'email'
        ));

        $email = new Zend_Form_Element_Text('email', array(
            'label' => 'Endereço de email',
            'required' => true,
        ));
        $email->addValidator(new Zend_Validate_EmailAddress());
        $email->addValidator($this->emailNaoRepetidoVal);
        $this->addElement($email);
        
        $senha = new Zend_Form_Element_Password('senha', array(
            'label' => 'Senha',
            'required' => true,
        ));
        $this->addElement($senha);
        
        $papel = new Zend_Form_Element_Select('papel', array(
            'label' => 'Papel',
            'required' => true,
        ));
        $papel->setMultiOptions(array(
            1 => 'Redator',
            2 => 'Admin'
        ));
        $this->addElement($papel);

        $submit = new Zend_Form_Element_Submit('submit', array(
            'label' => 'Salvar'
        ));
        $this->addElement($submit);
    }

    function setIdadmin($idadmin) {
        $this->emailNaoRepetidoVal->setExclude('idadmin != ' . $idadmin);
    }

}
