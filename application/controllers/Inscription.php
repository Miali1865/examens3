<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Inscription extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->model('login_model','login');
            $this->data['title'] = 'inscription';
            $this->data['error'] = '';
            $this->data['action'] = 'inscription/inscrire';
        }

        public function index(){
            if( isset( $_SESSION['data'] ) ){
                $this->data = $_SESSION['data'];
                $this->session->unset_userdata('data');                
            }
            $this->load->view('login' , $this->data);
        }
        
        public function inscrire(){
            $nom = $this->input->post("nom");
            $pwd = $this->input->post("mdp");
            try{
                $this->login->saveUser( $nom , $pwd );
                redirect( "login" );
            }catch( Exception $e ){
                $data['error'] = $e->getMessage();
                $this->session->set_userdata('data' , $this->data);
                redirect( "inscription" );
            }
        }

    }

?>