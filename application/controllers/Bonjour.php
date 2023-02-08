<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Bonjour extends CI_Controller {

        public function accueil() {
            $data = array();
            $data['nom'] = $this->input->get('nom');
            $data['plat'] = $this->input->get('plat');
            $data['boisson'] = $this->input->get('boisson');
            $this->load->view('Result',$data);
        }


        public function testb($pseudo = '') {
            echo 'Salut à toi : ' .$pseudo. '<br/>';
        } 
    }
?>