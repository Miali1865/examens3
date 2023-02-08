<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Taux extends CI_Controller {
        protected $data = array();

        public function __construct() {
            parent::__construct();
            $this->load->model('promotion_model','prom');
            $this->data['title'] = 'liste echange -Examen';
        }

        public function listEchange(){
            $idobj = $this->input->get("idobjet");
            $iduser = $_SESSION['user']['idutilisateur'];
            $this->session->set_userdata('objetEchange' ,  $this->prom->getAllAboutObjet( $idobj )  );
            $taux = $this->input->get("taux");
            $listObjet = $this->prom->listObjetForProm( $iduser  , $idobj , $taux  );
            $this->data['listObjet'] = $listObjet;
            $this->data['page'] = 'tauxEchange';
            // var_dump($listObjet);
            // var_dump($_SESSION);
            $this->load->view( 'Template' , $this->data );
        }

        public function Echange(){
            $offrant = $this->input->get("offrant");
            $propose = $this->input->get('propose');
            $objoffrant = $this->input->get('objoffrant');
            $objpropose = $this->input->get('objpropose');
            $this->load->model('user_model' , 'user');
            $this->user->insertProposition( $offrant , $propose , $objoffrant , $objpropose , 0 );
            $this->session->unset_userdata('objetEchange');            
            redirect('home');
        }

    }

?>