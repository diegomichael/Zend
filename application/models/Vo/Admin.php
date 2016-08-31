<?php

class Application_Model_Vo_Admin {

    private $idadmin;
    private $nome;
    private $email;
    private $senha;
    private $papel;

    function getIdadmin() {
        return $this->idadmin;
    }

    function getNome() {
        return $this->nome;
    }

    function getEmail() {
        return $this->email;
    }

    function getSenha() {
        return $this->senha;
    }

    function setIdadmin($idadmin) {
        $this->idadmin = $idadmin;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }
    
    function getPapel() {
        return $this->papel;
    }

    function setPapel($papel) {
        $this->papel = $papel;
    }

}
