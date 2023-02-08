<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Historique extends CI_Controller {

        protected $data = array();

        public function __construct() {
            parent::__construct();
            $this->load->model('admin_model','admin');
            $this->load->model('user_model','user');
            $this->data['title'] = 'Historique - Examen';
            // $this->data['page'] = 'index';
            $this->data['error'] = '';
            $this->data['cssLink'] = base_url().'assets/css/historique.css';
        }

        public function  Objet(){
            $idobjet =  $this->input->get("idobjet");
            $historiques = $this->user->historiqueObjet( $idobjet );
            $this->data['historiques'] = $historiques;
            $this->data['page'] = 'historique';
            $this->load->view( 'Template' , $this->data );
        }

    }

?>