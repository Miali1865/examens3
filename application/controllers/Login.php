<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Login extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->model('login_model','login');
            $this->data['title'] = 'Login';
            $this->data['error'] = '';
            $this->data['action'] = 'login/connect';
        }

        public function index(){
            if( isset( $_SESSION['data'] ) ){
                $this->data = $_SESSION['data'];
                $this->session->unset_userdata('data');                
            }
            $this->load->view('login' , $this->data);
        }

        public function logout(){
            $this->session->sess_destroy();
            redirect("login");
        }

        public function connect(){
            $nom = $this->input->post('nom');
            $mdp = $this->input->post('mdp');
            try{
                $user = $this->login->verifyUser( $nom , $mdp );
                $this->session->set_userdata( 'user' , $user  );
                redirect('home');
            }catch( Exception $e ){
                $this->data['error'] = $e->getMessage();
                $this->session->set_userdata('data' , $this->data);
                redirect( 'login' );
            }
            
        }

    }

?>
    