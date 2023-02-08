<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login_model extends CI_model{

/// login
    function getUserByNameAndPswd( $nom , $pwd ){
        $query = " select * from utilisateur where  nom = %s and mdp = %s ";
        $query = sprintf( $query , $this->db->escape($nom) , $this->db->escape($pwd));
        echo $query;
        $user = array();
        $query = $this->db->query($query); 
        if( $query->result_array() == false ){
            throw new Exception(" nom ou mot de passe incorrecte ");
        }else{
            $user = $query->row_array();
        }
        return $user;
    }

    function verifyUser( $nom , $pwd ){                  //vérifier si l'user existe
        $user = $this->getUserByNameAndPswd( $nom , $pwd );
        if( count( $user ) == 0 )
            throw new Exception(" nom ou mot de passe incorrecte ");        
        return $user;
    }

/// inscription
    public function verifyFormLogin( $nom , $mdp ){          //vérification du formulaire de l'update
        if( strlen($nom) == 0 || strlen($mdp) == 0 )
            throw new Exception(' nom ou mot de passe invalide ');
    }

    public function insertUser( $nom , $mdp ){
        $sql = " insert into utilisateur values( null , %s , %s )";
        $sql = sprintf( $sql , $this->db->escape($nom) , $this->db->escape($mdp) );
        echo $sql;
        $this->db->query($sql);
    }

    public function saveUser( $nom , $mdp ){
        try{
            $this->verifyFormLogin( $nom , $mdp );
            $this->insertUser( $nom , $mdp );
        }catch( Exception $e ){
            throw $e;
        }
    }
}

?>