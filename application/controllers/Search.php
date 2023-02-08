<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    require_once('SessionManager.php');
    class Search extends SessionManager {
        protected $data = array();

        public function __construct() {
            parent::__construct();
            $this->load->model('admin_model','admin');
            $this->load->model('user_model','user');
            $this->load->model('search_model','search');
            $this->data['title'] = 'Accueil - Examen';
            $this->data['page'] = 'search';
            $this->data['error'] = '';
            $this->data['admin'] = $this->admin->getAllCategorie();
        }


        public function categorie(){
            $titre = $this->input->get("titre");
            $idcategorie = $this->input->get("idcategorie");

            $objets = $this->search->getElementByNameAndCategory( $titre , $idcategorie );
            $this->data['objets'] = $objets;
            $this->session->set_userdata('data',$this->data);
            redirect( 'search/index' );
        }

        public function index(){
            if(isset($_SESSION['data'])) {
                $this->data = $_SESSION['data'];
                $this->session->unset_userdata('data');
            }
            
            $this->load->view('Template' , $this->data );
        }

    }

?>