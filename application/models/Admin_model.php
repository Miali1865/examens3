<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_model extends CI_model{
    public function getAllCategorie(){           ///tous les catégories
        $query = $this->db->query('select * from categorie');
        $categorie = array();
        foreach( $query->result_array() as $row ){
            array_push($categorie , $row );
        }
        return $categorie;
    }

    public function countUser(){                    //nombre d'utilisateur
        $query = $this->db->query('select count(idutilisateur) - 1 as isa from  utilisateur ');
        $nbr =0;
        foreach( $query->result_array() as $row ){
            $nbr = $row['isa'] ;
        }
        return $nbr;
    }

    public function countEchange(){                 //nombre d'echange
        $query = $this->db->query('select count(idechange) as isa from  echange ');
        $nbr =0;
        foreach( $query->result_array() as $row ){
            $nbr = $row['isa'] ;
        }
        return $nbr;
    }

    public function getCatgorieById( $id ){         //catégorie par son élement
        $query = $this->db->query('select * from categorie where idcategorie =  '.$id);
        $categorie =array();
        foreach( $query->result_array() as $row ){
            $categorie = $row ;
        }
        return $categorie;
    }

    public function verifyFormCategorie( $nom , $icone ){          //vérification du formulaire de l'update
        if( strlen($nom) == 0 || strlen($icone) == 0 )
            throw new Exception(' nom ou icone invalide ');
    }

    public function updateCategorie( $id , $nom , $icone ){         //modification de la catégorie dans la base
        $sql = "update categorie set nom = %s , icone = %s where idcategorie = %g  ";
        $sql = sprintf( $sql , $this->db->escape($nom) , $this->db->escape($icone) , $id );
        echo $sql;
        $this->db->query($sql);
    }

    public function modifyCategorie( $id , $nom , $icone  ){          //modification finale 
        try{
            $this->verifyFormCategorie( $nom , $icone );
            $this->updateCategorie( $id , $nom , $icone );
        }catch( Exception $e ){
            throw $e;
        }
    }
}

?>