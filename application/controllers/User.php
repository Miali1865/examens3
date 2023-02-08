<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    require_once('SessionManager.php');
    class User extends SessionManager {
        protected $data = array();

        public function __construct() {
            parent::__construct();
            $this->load->model('admin_model','admin');
            $this->load->model('user_model','user');
            $this->data['title'] = 'accepter';
            $this->data['error'] = '';
        }
        public function accepter(){
            try{
                $offrant = $this->input->get('offrant');
                $propose = $this->input->get('propose');
                $objetOffrant = $this->input->get('objetOffrant');
                $objetpropose = $this->input->get('objetpropose');

                $this->user->Echange( $offrant , $propose , $objetOffrant , $objetpropose );
                redirect("home/listeObjet");
            }catch( Exception $e ){
                $e->getMessage();
            }
        }

        public function refuser(){
            try{
                $offrant = $this->input->get('offrant');
                $propose = $this->input->get('propose');
                $objetOffrant = $this->input->get('objetOffrant');
                $objetpropose = $this->input->get('objetpropose');
                var_dump($_GET);
                $this->user->invalide( $objetpropose );          //invalidation de la proposition
                redirect("home/listeObjet");
            }catch( Exception $e ){
                $e->getMessage();
            }            
        }
    }

?>