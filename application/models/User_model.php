<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends CI_model{

    public function historiqueObjet( $idobjet ){                                     //historique d'un objet
        $sql = "select  * from historiqueproprietaire as hp
            natural join utilisateur as u
            natural join objet as o
        where idobjet = %g
        ";
        $sql = sprintf( $sql ,  $idobjet) ; 
        echo $sql;
        $query = $this->db->query( $sql );
        $historiques = array();
        foreach( $query->result_array() as $row ){
            array_push( $historiques , $row );
        }
        return $historiques;
    }


    public function insertHistorique( $ancien , $objet  , $nouveau ){
        $sql = " update historiqueproprietaire set datefin = now() where idproprietaire = %g and idobjet = %g" ;
        $sql = sprintf( $sql ,  $ancien , $objet) ; 
        echo $sql;
        $this->db->query($sql);
        $sql = "insert into historiqueproprietaire(  idhp , idproprietaire , datedebut , idobjet ) values( null ,  %g , now() , %g  ) ";
        $sql = sprintf( $sql ,  $nouveau , $objet) ; 
        echo $sql;
        $this->db->query($sql);
    }

    public function reinitialiseEtat( $idobjet ){                                 //change l'etat en 0
        $sql = " update objet set etatobjet = 0 where idobjet = %g  ";
        $sql = sprintf( $sql ,  $idobjet) ; 
        echo $sql;
        $this->db->query($sql);
    }

    public function insertEchange( $offrant , $propose , $idobjetoffrant , $idobjetPropose ){      //insertion des échanges effectuées 
        $sql = " insert into echange values( null , %g , %g , %g , %g , now() )   ";
        $sql = sprintf( $sql , $offrant , $propose , $idobjetoffrant , $idobjetPropose) ; 
        echo $sql;
        $this->db->query($sql);
    }

    public function findObjetProposition(  $offrant , $propose , $idobjetoffrant , $idobjetPropose ){          //savoir de quel échange nous parlons
        $sql = " select idproposition
            from proposition as p
            where offrant = %g 
            and propose = %g 
            and objetOffrant = %g
            and objetpropose = %g
        ";
        $sql = sprintf( $sql , $offrant , $propose , $idobjetoffrant , $idobjetPropose  );
        echo $sql;
        // echo 'huhu';
        $query = $this->db->query( $sql );
        $idproposition = 0;
        foreach( $query->result_array() as $row ){
            $idproposition = $row['idproposition'];
        }
        return $idproposition;
    }

    public function updateObjet( $iduser , $idobjet ){
        $sql = " update objet set idutilisateur = %g where idObjet = %g ";
        $sql = sprintf( $sql , $iduser , $idobjet) ; 
        echo $sql;
        $this->db->query($sql);
    }

    public function update(  $offrant , $propose  , $idobjetoffrant , $idobjetPropose ){            //échange des 2 objets
        $this->updateObjet( $offrant , $idobjetPropose );
        $this->updateObjet( $propose , $idobjetoffrant );
    }

    public function invalide( $idobjetPropose ){
        $sql = " update proposition set estvalide = 0 where objetpropose =  %g ";
        $sql = sprintf( $sql ,  $idobjetPropose) ; 
        echo $sql;
        $this->db->query($sql);
    }

    public function Echange(  $offrant , $propose  , $idobjetoffrant , $idobjetPropose ){           //l'echange entre les 2 utilisateurs
        $idproposition = $this->findObjetProposition( $offrant , $propose  , $idobjetoffrant , $idobjetPropose );
        $this->invalide( $idobjetPropose );          //invalidation de la proposition
        try{
            $this->update( $offrant , $propose  , $idobjetoffrant , $idobjetPropose );
            //réinitialisation de l'etat des objets
            $this->reinitialiseEtat( $idobjetoffrant );
            $this->reinitialiseEtat( $idobjetPropose );
            $this->insertEchange( $offrant , $propose  , $idobjetoffrant , $idobjetPropose );
            
            ///insertion historique
            $this->insertHistorique( $propose , $idobjetPropose  , $offrant   );
            $this->insertHistorique( $offrant , $idobjetoffrant , $propose   );
        }catch( Exception $e ){
            throw $e;
        }
    }

    
    public function getDetailObjet( $idObjet ){                     //photo d'une objet
        $sql = "select * 
        from  objet
        where idObjet = %g";
        $sql = sprintf( $sql , $idObjet );
        // echo $sql;
        $query = $this->db->query( $sql );
        $picture = array();
        foreach( $query->result_array() as $row ){
            array_push($picture , $row );
        }
        return $picture;
    }



    public function getPictureOfObject( $idObjet ){                     //photo d'une objet
        $sql = "select * 
        from  photoObjet
        where idObjet = %g";
        $sql = sprintf( $sql , $idObjet );
        // echo $sql;
        $query = $this->db->query( $sql );
        $picture = array();
        foreach( $query->result_array() as $row ){
            array_push($picture , $row );
        }
        return $picture;
    }

    public function getEtatObject( $etat ){            //état d'un objet
        if( $etat == 0 )    return "Echanger";
        if( $etat == 1 )    return "En Cours d'échange";
        if( $etat == 2 )    return "En attente de votre réponse";
    }

    public function listedetailEchange( $id , $idobjet) {
        $sql = "select p.idproposition,u.nom as nomoffrant,ut.nom as propose,o.titre as nomobjetOffrant,o.idObjet as objetaoffrir,ob.titre as objetpropose,ob.idObjet as objetvolu,o.prixEstimatif as prixOffrant,ob.prixEstimatif as prixPropose , p.offrant as offrant ,
        propose as proposeuser ,  
        objetOffrant ,
        objetpropose 
        from proposition as p 
            join utilisateur as u on u.idutilisateur = p.offrant
            join utilisateur as ut on ut.idutilisateur = p.propose
            join objet as o on o.idObjet = p.objetOffrant
            join objet as ob on ob.idObjet = p.objetpropose
        where p.propose =  %g and ob.idObjet = %g";
        // echo $idobjet."</br>";
        $sql = sprintf( $sql , $id , $idobjet);
        echo $sql."</br>";
        $query = $this->db->query( $sql );
        $object = array();
        $i=0;
        foreach( $query->result_array() as $row ){
            array_push($object , $row );
            $object[$i]['image'] = $this->getPictureOfObject( $object[$i]['offrant'] );
            $i++;
        }
        // var_dump($object);
        return $object;
    }

    public function getListObject( $id ){                             //mes objets
        $sql = "select u.idutilisateur as idutilisateur , nom , idobjet , titre , prixEstimatif , etatobjet
        from  objet as o
        natural join utilisateur as u
        where u.idutilisateur =  %g ";
        $sql = sprintf( $sql , $id );
        $query = $this->db->query( $sql );
        $object = array();
        $i = 0;
        foreach( $query->result_array() as $row ){
            $object[$i] = $row;
            $object[$i]['photo'] = $this->getPictureOfObject( $object[$i]['idobjet'] ); 
            $object[$i]['etatObjHtml'] = $this->getEtatObject( $object[$i]['etatobjet'] ); 
            $i++;
        }
        return $object;
    }


/// insertion objet

    public function getLastId(){
        $sql = " select getlast_id() as last ";
        echo $sql;
        $sql = $this->db->query($sql);
        $row = $sql->row_array();
        return $row['last'];
    }

    public function getAllCheck( $get , $listeCategorie ){
        $name = "";
        $array = array();
        foreach( $listeCategorie as $list ){
            $name = $list['idcategorie']."-categ";
            if( !empty( $get[$name] ) ){
                array_push( $array , $list['idcategorie'] );
            }
        }
        if( count($array) == 0 )    throw new Exception(" auncune catégorie selectionné  ");
        return $array;
    }

    public function  insertCategorie( $user , $idcategorie ){
        $sql = " insert into objetcategorie values(  %g  , %g )";
        $sql = sprintf( $sql , $idcategorie , $user );
        echo $sql;
        $sql = $this->db->query($sql);
    }



    public function insertObject( $titre , $idutilisateur , $prixestimatif , $listeCategorie , $get ) {
        $sql = " insert into objet( idObjet , titre   , idutilisateur , prixEstimatif ) values ( null , %s , %g , %g)";
        $sql = sprintf( $sql , $this->db->escape($titre) , $idutilisateur , $prixestimatif) ; 
        echo $sql;
        $idcategorie = $this->getLastId();
        $this->db->query($sql);
        try{
            $list = $this->getAllCheck( $get , $listeCategorie );
            foreach( $list as $l ){
                $this->insertCategorie( $idcategorie , $l );
            }
        }catch( Exception $e ){
            throw $e;
        }
    }
 

/// change
    public function searchObjet( $iduser , $idcategory  ){
        $sql = "select *
        from objet as ob 
            natural join objetcategorie
            natural join utilisateur as ut
        where  ob.idutilisateur <> %g and  idcategorie = %g ";
        $sql = sprintf( $sql , $iduser , $idcategory );
        $query = $this->db->query( $sql );
        $object = array();
        foreach( $query->result_array() as $row ){
            array_push($object , $row );
        }
        return $object;

    }


    public function listeEchange( $id ){
        $sql = "select distinct ob.idObjet as objetvolu,ut.nom as propose,ob.titre as objetpropose
        from proposition as p 
            join utilisateur as u on u.idutilisateur = p.offrant
            join utilisateur as ut on ut.idutilisateur = p.propose
            join objet as o on o.idObjet = p.objetOffrant
            join objet as ob on ob.idObjet = p.objetpropose
        where p.propose =  %g and estvalide = 1";
        $sql = sprintf( $sql , $id );
        $query = $this->db->query( $sql );
        $object = array();
        foreach( $query->result_array() as $row ){
            array_push($object , $row );
        }
        return $object;
    }


    public function insertPhoto( $idObjet , $nom) {
        $sql = " insert into photoObjet values ( null , %g , %s )" ;
        $sql = sprintf( $sql , $idObjet , $this->db->escape($nom) );
        echo $sql;
        $this->db->query($sql);
    }

    public function updateEtatObjet( $idobjet , $iduser , $etat ){
        $sql = " update objet set etatObjet = %g where idObjet = %g  and idutilisateur = %g " ;
        $sql = sprintf( $sql , $etat , $idobjet , $iduser  );
        echo $sql;
        $this->db->query($sql);
    }

    public function insertProposition ( $offrant , $propose , $objetOffrant , $objetpropose , $estvalide ){
        $sql = " insert into proposition values ( null , %g , %g , %g , %g , %g)";
        $sql = sprintf( $sql , $offrant , $propose , $objetOffrant , $objetpropose , $estvalide ) ; 
        echo $sql;
        $this->db->query($sql);
        $this->updateEtatObjet( $objetOffrant , $offrant , 1 );
        $this->updateEtatObjet( $objetpropose , $propose , 2 );
    }


}