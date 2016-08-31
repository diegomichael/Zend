<?php

    class Application_Form_PratoGerente extends Zend_Form {
       
        
        public function init() {

            $this->setMethod('post');
            $prato = new Zend_Form_Element_Text('prato' , array(
                'label' => 'Nome do Prato',
                'required' => true
            ));
            $this->addElement($prato);

            $categoria = new Zend_Form_Element_Select('idcategoria', array(
                'label' => "Categoria",
                'required' =>true
            ));
            $this->addElement($categoria);
            
            $preco = new Zend_Form_Element_Text('preco', array(
                'label' => "preco",
                'required' =>true
            ));
            $this->addElement($preco);


            $categoria->setMultiOptions($this->pegarCategorias());

            $filtro = new Zend_Filter_Null();
            $categoria->addFilter($filtro);

            $botao = new Zend_Form_Element_Submit('botao', array(
                'label'=>'Salvar'
            ));
            $this->addElement($botao);
        
       
    }
    
    private function pegarCategorias(){
        $tab = new Application_Model_DbTable_Categoria();
        $categorias = $tab->fetchAll()->toArray();
        
        $options = array();
        $options[0] = "Selecione";
        foreach ($categorias as $item) {
            $idcategoria = $item['idcategoria'];
            $nomecategoria = $item['categoria'];
            
            $options[$idcategoria] = $nomecategoria;
        }
        return $options;
    }

        
        
        
        
    }
