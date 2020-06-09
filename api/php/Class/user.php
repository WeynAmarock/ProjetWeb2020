<?php 

class User{
    private $mail;
    private $nom;
    private $prenom;
    private $password;
    private $admin;

    /*function __construct($mail,$nom,$prenom,$password,$admin){
        $this->mail=$mail;
        $this->nom=$nom;
        $this->prenom=$prenom;
        $this->password=$password;
        $this->admin=$admin;
    }*/

    public function getMail(){
        return $this->mail;
    }

    public function getNom(){
        return $this->nom;
    }

    public function getPrenom(){
        return $this->prenom;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getAdmin(){
        return $this->admin;
    }

    public function setMail($mail){
        $this->mail=$mail;
    }

    public function setNom($nom){
        $this->nom=$nom;
    }

    public function setPrenom($prenom){
        $this->prenom=$prenom;
    }

    public function setPassWord($password){
        $this->password=$password;
    }

    public function setAdmin($admin){
        $this->admin=$admin;
    }
}