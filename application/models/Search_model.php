<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Search_model extends CI_model{

    public function getDistinct( $query ){
        $sql = " select * from objet as o
        natural join objetcategorie
        natural join utilisateur
        as oc where idobjet in ( ". $query ." ) ";
        return $sql;
    }


    public function getRequeteSearch( $name , $category ){
        $query = " select distinct(idobjet) from objet as o
            natural join objetcategorie as oc         
        ";
        if( strlen($name) != 0 ){ 
            $query .= " where titre like '%s%s%s' ";
            if( $category != 0 ){
                $query .= "and idcategorie = %g ";
                $query = sprintf( $query , '%' , $name , '%' , $category );
            }else{
                $query = sprintf( $query , '%' , $name , '%' );
            }
        }else{
            if( $category != 0 ){
                $query .= "where idcategorie = %g ";
                $query = sprintf( $query , $category );
            }
        }
        return $query;
    }

    public function getElementByNameAndCategory( $name , $category ){                //recherche par titre et catégorie
        $query = $this->getRequeteSearch( $name , $category );
        $query = $this->getDistinct( $query );
        // echo $query;
        $query = $this->db->query($query);
        $objets = array(); 
        foreach( $query->result_array() as $row ){
            array_push( $objets , $row );
        }
        // var_dump($objets);
        return $objets;
    }
}