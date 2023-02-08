<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Multi_model extends CI_model{

    public function getAllObjetWithoutUser( $iduser ){
        $this->load->model('user_model','user');
        $sql = " select * from objet 
            natural join utilisateur
            where idutilisateur <> %g
        ";
        $sql = sprintf( $sql , $iduser );
        $query = $this->db->query( $sql );
        $object = array();
        foreach( $query->result_array() as $row ){
            array_push($object , $row );

        }
        return $object;
    }

    public function getListObjetcUserValide( $iduser ){
        $sql = " select * from objet 
        natural join utilisateur
        where idutilisateur <> %g
    ";
    $sql = sprintf( $sql , $iduser );
    $query = $this->db->query( $sql );
    $object = array();
    foreach( $query->result_array() as $row ){
        array_push($object , $row );
    }
    return $object;
    }

}

?>