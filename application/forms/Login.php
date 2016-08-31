<?php

class Application_Form_Login extends Zend_Form {

    public function init() {
        $this->setMethod('post');

        $email = new Zend_Form_Element_Text('email', array(
            'label' => 'Endereço de email',
            'required' => true,
        ));
        $email->addValidator(new Zend_Validate_EmailAddress());
        $this->addElement($email);

        $senha = new Zend_Form_Element_Password('senha', array(
            'label' => 'Senha',
            'required' => true,
        ));
        $this->addElement($senha);

        $submit = new Zend_Form_Element_Submit('submit', array(
            'label' => 'Entrar'
        ));
        $this->addElement($submit);
    }

}
