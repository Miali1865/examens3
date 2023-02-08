<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Promotion_model extends CI_model{
        public function getPrixObject( $idobjet ){                                               //le prix d'un objet
            $sql = "select prixEstimatif from objet where idObjet = %g";
            $sql = sprintf( $sql , $idobjet );
            echo $sql;
            $query = $this->db->query($sql); 
            $row = $query->row_array();
            return $row['prixEstimatif'];
        }

        public function getInterval(  $taux , $valeur ){                              //interval de 10% ou 20%
            $interval = array();
            $interval[0] = $valeur - ( $valeur*($taux/100) );
            $interval[1] = $valeur + ( $valeur*($taux/100) );
            return $interval;
        }
        
        public function getAllAboutObjet( $idobjet ){
            $this->load->model('user_model' , 'user');
            $sql = "select * from objet 
                natural join utilisateur
                where idObjet = %g
            ";
            $sql = sprintf( $sql , $idobjet );
            echo $sql;
            $objet = array();
            $query = $this->db->query($sql);
            $row = $query->row_array(); 
            $objet = $row;
            $objet['photo'] = $this->user->getPictureOfObject( $objet['idObjet'] );
            return $objet;
        }

        public function getAllObjetValide( $interval , $iduser , $prix ){                                    //les objets qui rentrent dans l 'interval
            $this->load->model('user_model' , 'user');
            $sql = "select * from objet 
                natural join utilisateur
                where prixEstimatif between %g 
                and %g
                and idutilisateur <> %g
            ";
            $sql = sprintf( $sql , $interval[0] , $interval[1] , $iduser );
            echo $sql;
            $objets = array();
            $query = $this->db->query($sql); 
            $i = 0 ;
            foreach( $query->result_array() as $row ){
                array_push( $objets , $row );
                $objets[$i]['photo'] = $this->user->getPictureOfObject( $objets[$i]['idObjet'] );
                $objets[$i]['difference'] = $this->difference( $prix , $objets[$i]['prixEstimatif'] );
                $i++;
            }

            return $objets;
        }

        public function listObjetForProm( $iduser , $idobjet , $taux ){
            $prix = $this->getPrixObject( $idobjet );
            $interval = $this->getInterval(  $taux , $prix );
            $listObjets = $this->getAllObjetValide( $interval , $iduser , $prix );

            return $listObjets;
        }

/// la différence en %
        public function difference( $prixuser , $prixclient ){
            $signe = '-';
            if( $prixuser < $prixclient ){
                $signe = '+';
            }
            $difference = abs($prixclient - $prixuser) ;
            return $signe .''. $difference .'%' ;
        }
                    
    }

?>